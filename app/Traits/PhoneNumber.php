<?php

namespace App\Traits;

use libphonenumber\PhoneNumberUtil;

trait PhoneNumber
{
    public function GetPhoneNumber($phone, $country_code, $isRegionCode = false)
    {

        $phoneUtil = PhoneNumberUtil::getInstance();


        $regionCode = $this->GetRegionCode($country_code, $isRegionCode);

        $phoneNumber = $phoneUtil->parse($phone, $regionCode);

        $data = [
            'phone' => $phoneNumber->getNationalNumber(),
            'region_code' => $regionCode,
            'country_code' => $country_code,
        ];

        return $data;
    }

    private function GetRegionCode($country_code, $isRegionCode = false)
    {

        $phoneUtil = PhoneNumberUtil::getInstance();

        if (!$isRegionCode) {
            $country_code = ltrim($country_code, '+');
            return $phoneUtil->getRegionCodeForCountryCode((int) $country_code);
        }
        return $country_code;
    }

    public function getCountryCodeFromRegion(string $regionCode): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $countryCode = $phoneUtil->getCountryCodeForRegion(strtoupper($regionCode));

        return '+' . $countryCode;
    }
}
