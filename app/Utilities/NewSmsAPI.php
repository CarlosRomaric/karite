<?php

namespace App\Utilities;

class NewSmsAPI {

    protected $base_url = 'https://sms.lorbouor.org/api/v1';

    private $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YTYyODM2MS1iMzJiLTRlMjMtYTk4Ni1hYmM3NjI0NzE0MDkiLCJqdGkiOiJiY2FlOTZlMTFkNjQzODBkNzI0MGRkMTFiMjVkNDk1OTkxZjVjMTcyMjAxZDAwZTUxYTc4MWMzNDdiMTU3NmIxY2E3NjYzYjBiMGY5MmI0NyIsImlhdCI6MTczMDI3OTY3OC45NDM0NTYsIm5iZiI6MTczMDI3OTY3OC45NDM0NjMsImV4cCI6MTc2MTgxNTY3OC44MjA2MzksInN1YiI6Ijk3YTk1ZDFiLTI2NjEtNDM2My1hZTA5LWY3NWZiMTJhMTMxZiIsInNjb3BlcyI6WyIqIl19.ZC8WL6ANh1Fd-i3e8rZU-akjubRN3baOu1B8FlrFmB6J4nPACRi_Sgv6dLctF2Om35V72qdHZseNcMlPZDKa2IGRK_6v-S2bruEER-VC_Sq4b_TNdmfSkC5plcycHftfHvNh1VjAgk7pS0R4Cb3WdiKkUS7ySRyZWWDi9mImOR8qMDv_KF_S_AyW9I1en23crOhtf3SgFozEh48mtEJsBIUs9w0gDYhJWXFUuP5ebr_7WhTBnV0Bn9U0E-tJtsC06GkAn8MAKTw6LyHGlukTSKSkbi9TisRHr5GIIxayr-u41lQ05n1uSYX3AkfOr4GGltaRDz36HDk9jdq_0RYs09UAbvaoJYWRLeZW9G1y0QKmhLyTdhcJFNVpQbSu0j2pckWFaRcRrP8P0e0U5vTWntWtrd2EsCpW3Kcuev-l-BElWSqzhkNXi2vhOnaFq6QUQCdPKLTzs9u1LKvvtQh_ETF7N-YXEIG8VUiEqdv_QsmQNcPrSoiQ4JijX8mqJ1WHKUxxe_QswP4XHKDUUoKNOIhuVxgQjXoGoanWdAbGAhKxgfYlFJFRLLy7uvi3N4z0NyIkf3sijtQJZOjMVyp35SRtTG7hLtJq9EOoVDhXbm80SKyRqlIP3Wo4I-UwEK9eKN8HR5gd80UkYdKAuOGjqpnlQCILk6x_pB2TPb_iRFM';

    // public function __construct($token) {
    //     $this->token = $token;
    // }

    public function getBalance() {
        $url = $this->base_url.'/balance';
        $headers = [
            'Authorization: Bearer ' . $this->token,
            'Content-type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            $data = json_decode($response, true);
            return $data['balance'];
        } elseif ($status == 401) {
            return "Non authentifié";
        } else {
            return "Erreur inconnue";
        }
    }

    public  function sendSMS($phoneNumbers, $content) {
        $url = $this->base_url.'/send-message';
        $headers = [
            'Authorization: Bearer ' . $this->token,
            'Content-type: application/json',
            'Accept: application/json'
        ];

        $data = [
            'phone_number' => $phoneNumbers,
            'content' => $content
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            return "L'opération a bien été traitée.";
        } elseif ($status == 400) {
            $data = json_decode($response, true);
            return $data['message'];
        } elseif ($status == 401) {
            return "Unauthenticated";
        } else {
            return "Erreur inconnue";
        }
    }

    public function sendSMSInBackground($phoneNumbers, $content) {
        $url = $this->base_url.'/send-message/in-background';
        $headers = [
            'Authorization: Bearer ' . $this->token,
            'Content-type: application/json',
            'Accept: application/json'
        ];

        $data = [
            'phone_number' => $phoneNumbers,
            'content' => $content
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            return "L'opération a bien été traitée.";
        } elseif ($status == 400) {
            $data = json_decode($response, true);
            return $data['message'];
        } elseif ($status == 401) {
            return "Unauthenticated";
        } else {
            return "Erreur inconnue";
        }
    }

}