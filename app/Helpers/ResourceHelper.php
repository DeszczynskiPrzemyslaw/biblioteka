<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Request;

abstract class ResourceHelper
{
    public static function expands(string $name): string
    {
        return in_array($name, explode(',', Request::get('expand')));
    }
}
