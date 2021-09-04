<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // categorized phone numbers by country, state, country code $ number
        $arr = explode(')', $this->phone);

        $code = ltrim(current($arr), '(');

        $response = $this->getCountry($code, last($arr));

        return [
            'country'   => $response['country'],
            'state' => $response['state'],
            'country_code' => "+{$code}",
            'phone' => last($arr)
        ];
    }

    public function getCountry ($code, $number)
    {
        // you can edit structure database and add countries table and make a relation
        // with each customers but the task not required that so i will check manually without any packages
        switch ($code) {
            case '237':
                return [
                    'country' => 'cameroon',
                    'state' => preg_match('/[2368]\d{7,8}$/', $number)
                ];
            case '251':
                return [
                    'country' => 'ethiopia',
                    'state' => preg_match('/[1-59]\d{8}$/', $number)
                ];
            case '212':
                return [
                    'country' => 'morocco', // 520123456
                    'state' => preg_match('/[5-9]\d{8}$/', $number)
                ];
            case '258':
                return [
                    'country' => 'mozambique',
                    'state' => preg_match('/[28]\d{7,8}$/', $number)
                ];
            case '256':
                return [
                    'country' => 'uganda',
                    'state' => preg_match('/\d{9}$/', $number)
                ];
            default:
                return [
                    'country' => 'unknown',
                    'state' => false
                ];
        }
    }
}
