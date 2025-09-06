<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use ApiResponseTrait;

    public function index($type)
    {
        switch ($type) {

            case 'privacy-policy':
                $settings = [
                    'policy_desc' => getSetting('policy_desc', app()->getLocale()),
                ];
                break;

            case 'about-us':
                $settings = [
                    'about_desc' => getSetting('about_desc', app()->getLocale()),
                ];
                break;

            case 'contact-us':
                $settings = [
                    'phone'        => getSetting('phone'),
                    'email'        => getSetting('email'),
                    'whatsapp'     => getSetting('whatsapp'),
                ];
                break;
            case 'app-links':
                $settings = [
                    'google_play'  => getSetting('googlePlay'),
                    'app_store'    => getSetting('appStore'),
                ];
                break;


            default:
                return $this->notFoundResponse();
        }

        return $this->ApiResponse($settings);
    }
}
