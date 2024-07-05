<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 23/10/2019
 * Time: 02:37
 */

namespace App\Http\Controllers\Traits;


use App\Utilities\HttpStatus;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{

    /**
     * Unauthorized
     *
     * @return JsonResponse
     */
    public static function unauthorized(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Unauthorized'
            ]
        ], HttpStatus::HTTP_UNAUTHORIZED);
    }

    /**
     * Unauthenticated
     *
     * @return JsonResponse
     */
    public static function unauthenticated(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Unauthenticated'
            ]
        ], HttpStatus::HTTP_FORBIDDEN);
    }

    /**
     * Authenticated
     *
     * @return JsonResponse
     */
    public static function authenticated(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Successfully logged in'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Logged Out
     *
     * @return JsonResponse
     */
    public static function loggedOut(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Successfully logged out'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Content is created
     *
     * @return JsonResponse
     */
    public static function contentCreated(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Content is created'
            ]
        ], HttpStatus::HTTP_CREATED);
    }

    /**
     * Content is updated
     *
     * @return JsonResponse
     */
    public static function contentUpdated(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Content is updated'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Content is deleted
     *
     * @return JsonResponse
     */
    public static function contentDeleted(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Content is deleted'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Request is failed
     *
     * @return JsonResponse
     */
    public static function requestFailed(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Request is failed'
            ]
        ], HttpStatus::HTTP_BAD_REQUEST);
    }


    /**
     * Content processing error
     *
     * @return JsonResponse
     */
    public static function contentProcessingError(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Error in processing'
            ]
        ], HttpStatus::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Confirm number
     *
     * @return JsonResponse
     */
    public static function confirmedNumber(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Number is confirmed'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Resource not found
     *
     * @return JsonResponse
     */
    public static function resourceNotFound(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Resource you want to access is not found'
            ]
        ], HttpStatus::HTTP_FORBIDDEN);
    }

    /**
     * Resource not found
     *
     * @return JsonResponse
     */
    public static function accountIsDisabled(): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Account is disabled'
            ]
        ], HttpStatus::HTTP_OK);
    }

    /**
     * Resource not found
     *
     * @param $status
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    public static function customMessage($status, $message, $code): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => $status,
                'message' => $message
            ]
        ], $code);
    }

    /**
     * Custom validator errors
     *
     * @param $errors
     * @param null $message
     * @return JsonResponse
     */
    public static function validatorError($errors, $message = null)
    {
        return response()->json([
            "message" => $message,
            "errors" => $errors
        ], HttpStatus::HTTP_UNPROCESSABLE_ENTITY);
    }

}
