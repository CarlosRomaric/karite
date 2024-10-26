<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AfribaPayService
{
    private $baseUrl;
    private $clientId;
    private $clientSecret;
    private $merchantKey;

    public function __construct()
    {
        $this->baseUrl = env('AFRIBAPAY_BASE_URL');
        $this->clientId = env('AFRIBAPAY_CLIENT_ID');
        $this->clientSecret = env('AFRIBAPAY_CLIENT_SECRET');
        $this->merchantKey = env('AFRIBAPAY_MERCHANT_KEY');
    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->baseUrl}/token", []);

        if ($response->successful()) {
            return $response->json()['data']['access_token'];
        }

        throw new \Exception('Failed to retrieve access token');
    }

    public function initiatePayIn($operator, $country, $phoneNumber, $amount, $currency, $orderId, $referenceId, $lang, $returnUrl, $cancelUrl, $notifyUrl)
    {
        $accessToken = $this->getAccessToken();

        $payload = [
            'operator' => $operator,
            'country' => $country,
            'phone_number' => $phoneNumber,
            'amount' => $amount,
            'currency' => $currency,
            'order_id' => $orderId,
            'merchant_key' => $this->merchantKey,
            'reference_id' => $referenceId,
            'lang' => $lang,
            'return_url' => $returnUrl,
            'cancel_url' => $cancelUrl,
            'notify_url' => $notifyUrl,
        ];

        $response = Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post("{$this->baseUrl}/pay/payin", $payload);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to initiate PayIn transaction');
    }

    public function confirmPayInWithOTP($operator, $otpCode, $country, $phoneNumber, $amount, $currency, $orderId, $referenceId, $lang, $returnUrl, $cancelUrl, $notifyUrl)
    {
        $accessToken = $this->getAccessToken();

        $payload = [
            'operator' => $operator,
            'otp_code' => $otpCode,
            'country' => $country,
            'phone_number' => $phoneNumber,
            'amount' => $amount,
            'currency' => $currency,
            'order_id' => $orderId,
            'merchant_key' => $this->merchantKey,
            'reference_id' => $referenceId,
            'lang' => $lang,
            'return_url' => $returnUrl,
            'cancel_url' => $cancelUrl,
            'notify_url' => $notifyUrl,
        ];

        $response = Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post("{$this->baseUrl}/pay/payin", $payload);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to confirm PayIn transaction with OTP');
    }
}
