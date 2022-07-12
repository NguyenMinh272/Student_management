<?php
namespace  App\Classes;

class StudentService
{
    public static function detectPhone($phone)
    {
        $telecoms = [
            'Viettel' => [
                '032',
                '033',
                '034',
                '035',
                '036',
                '037',
                '038',
                '039',
            ],
            'Mobifone' => [
                '070',
                '079',
                '077',
                '076',
                '078',
            ],
            'Vinaphone' => [
                '083',
                '084',
                '085',
                '081',
                '082',
            ],
            'Vietnamobile' => [
                '056',
                '058',
            ],
            'Gmobile' => [
                '059'
            ],
        ];

        $telecomNameResult = '';
        preg_match("/\d{3}/", $phone, $phonePrefix);

        foreach ($telecoms as $telecomName => $telecom) {
            if (in_array($phonePrefix[0], $telecom)) {
                $telecomNameResult = $telecomName;
            }
        }
        return $telecomNameResult;
    }
}
