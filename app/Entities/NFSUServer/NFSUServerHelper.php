<?php

namespace App\Entities\NFSUServer;

class NFSUServerHelper
{
    public static function str2Hex($str): string
    {
        $hex = '';

        for ($i = 3; $i >= 0; $i--) {
            if (ord($str[$i]) > 15) {
                $hex .= dechex(ord($str[$i]));
            } else {
                $hex .= '0' . dechex(ord($str[$i]));
            }
        }

        return $hex;
    }
}
