<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 21/03/2020
 * Time: 00:03
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('date_format_fr')) {
    /**
     * @param $date
     * @return string
     */
    function date_format_fr($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }
}

if (!function_exists('custom_date')) {
    /**
     * @param $date
     * @return string
     */
    function custom_date($date) {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }
}

if (!function_exists('format_amount')) {
    /**
     * @param $amount
     * @return string
     */
    function format_amount($amount) {
        return number_format($amount,0, '.', ' ');
    }
}

if (!function_exists('date_format_fr')) {
    /**
     * @param $date
     * @return string
     */
    function date_format_fr($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }
}

if (!function_exists('my_date_format_fr')) {
    /**
     * @param $date
     * @return string
     */
    function my_date_format_fr($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
}

if (!function_exists('custom_date_format')) {
    /**
     * @param $date
     * @return string
     */
    function custom_date_format($from, $to, $date) {
        return Carbon::createFromFormat($from, $date)->format($to);
    }
}

if (!function_exists('format_amount')) {
    /**
     * @param $amount
     * @return string
     */
    function format_amount($amount) {
        return number_format($amount,0, '.', ' ');
    }
}

if (!function_exists('sessionFlash')) {
    /**
     * @param $key
     * @param null $value
     * @return void
     */
    function sessionFlash($key, $value = null)
    {
        $key = is_array($key) ? $key : [$key => $value];

        foreach ($key as $k => $v) {
            session()->flash($k, $v);
        }
    }
}

if (!function_exists('storeBase64ToImage')) {
    function  storeBase64ToImage($base64Image) {

        // data:image/jpeg;base64, data:image/png;base64, Si l'image débute avec ceci alors on a besoin du code en commentaire

        //$base64Image = request()->get('picture'); // your base64 encoded
        //@list($type, $fileData) = explode(';', $base64Image);
        //@list(, $fileData) = explode(',', $fileData);

        $imageName = Str::uuid()->toString();
        $imagePath = "farmers/{$imageName}.png";
        Storage::disk('public')->put($imagePath, base64_decode($base64Image));

        return $imagePath;
    }
}
