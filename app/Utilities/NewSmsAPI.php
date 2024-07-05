<?php

namespace App\Utilities;

class NewSmsAPI {

    protected $base_url = 'https://sms.lorbouor.org/api/v1';

    private $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YTYyODM2MS1iMzJiLTRlMjMtYTk4Ni1hYmM3NjI0NzE0MDkiLCJqdGkiOiJjM2FmYjdkNjgyMjYwOGY3MDlkODRlM2JjMjRjNTQ4NTcxYzM4ZTM1ZjMxNTZmYmU1NzNlM2I3MmNkMDhkYzI2YzNhYjk0MzJhN2JiYWY3NCIsImlhdCI6MTcxMjI5OTk4NC43MzQ2MDgsIm5iZiI6MTcxMjI5OTk4NC43MzQ2MTIsImV4cCI6MTc0MzgzNTk4NC42ODkzMTUsInN1YiI6IjllZjNmOTljLTNlOTYtNGM2ZC1iM2VhLWQwZjZkMzY2NTBiNSIsInNjb3BlcyI6WyIqIl19.tZ_GuGGH1qvPjBIVrX6U594gPUbGzPlQnaCM-Nm27ycq7D4FVUtNxlfV84UNs57Q-d_J4gbdjJFpSIyiGtmkTqCmP4ud-SGIqiGfepiUyfPlNIhTN0yLI20X-HvX3cVTDGoSSfM4MqVSrJoT-HMmmWPcpUdFeHDBJA_Wl10DbibjsVkgYjijz8T9EtcbqrUj7PHsnhvjS_78FvSuUa-sspyll63PxF47CFsuAfNkaVykLeShHsZPoYjDDZEZMclEBZqeE7Q5uz8UvExmvV_wo-vYyjQ5X2FJ70uNJZDxHC4iIEDxlNPUF7peOz5aQJCQ0e-sw2KOxbMAW0Y2yjtGG1CULDiAmkB3EV92oQzHPo3J6MuZmyaoRGIIzziCTBnklSkiZNdBWLe6RFJD9JAknP5pz3LxYu2rF6CixD62kJmboWgAHxewmQ9Icqe-CskdyXpm8NKAxAOikf26HY2dIQqCmjGbofeHfead5V75XoHTgxd5NEeWPjJivqbVBw146T-IKfoETSH_JO_HJlvbaDBLQViBDw2JzGfejdsvpym0HSzqPrq4sQOLlOSEd97J-dDVSGhUpYhnInBbpWnFVFfq3lYjLZLwBv4twkyA2zaKFZ-y31eunnrIK5mm7_5dZC5vmiYc0-V0sWxqOgs7uqPZviVWcfIHXEbLjsyztkI';

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