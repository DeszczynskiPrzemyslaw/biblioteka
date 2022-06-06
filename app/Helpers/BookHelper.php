<?php

namespace App\Helpers;

abstract class BookHelper
{
    public static function generateISBN(): string
    {
        $ISBN = '';
        for ($i = 0; $i<=12; $i++) {
            $ISBN .= mt_rand(0,9);
        }

        return $ISBN;
    }
}
