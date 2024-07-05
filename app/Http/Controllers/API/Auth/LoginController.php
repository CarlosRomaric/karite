<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Login default action
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function __invoke(LoginRequest $request)
    {
        if (! $this->attemptLogin($request)) {
            return self::unauthenticated();
        }
        return $this->userToken($request);
    }

    /**
     * Set User Token
     *
     * @param Request $request
     * @return mixed
     */
    protected function userToken(Request $request)
    {
        $user = $request->user();

        $tokenResult = $this->createUserToken($user);

        $token = $tokenResult->token;

        $this->rememberUser($request, $token);

        if ($token->save()) {
            //$this->authenticated($user);
            return $this->sendLoginResponse($request, $tokenResult);
        }
        return self::resourceNotFound();
    }

    /**
     * Send Login Response
     *
     * @param $request
     * @param $tokenResult
     * @return object
     */
    protected function sendLoginResponse($request, $tokenResult)
    {
        return response()->json([
            'user' => $request->user(),
            'meta' => [
                'token_type' => 'Bearer',
                'expires_at' =>
                    Carbon::parse($tokenResult->token->expires_at)
                        ->toDateTimeString(),
                'access_token' => $tokenResult->accessToken,
            ]
        ]);
    }

    /**
     * Create user token
     *
     * @param User $user
     * @return mixed
     */
    protected function createUserToken(User $user)
    {
        return $user->createToken('Personal access token', ['*']);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if (is_numeric($request->get('username'))) {
            return [
                'phone' => $request->get('username'),
                'password' => $request->get('password')
            ];
        }
        elseif (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $request->get('username'),
                'password' => $request->get('password')
            ];
        }
        return [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
    }

    /**
     * Set Remember
     *
     * @param Request $request
     * @param $token
     */
    protected function rememberUser(Request $request, $token)
    {
        if ($request->get('remember_me')) {
            $token->expires_at = now()->addMonths(12);
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool|JsonResponse
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $this->credentials($request),
            (bool) $request->filled('remember_me')
        );
    }
}
