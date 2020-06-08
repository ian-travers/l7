<?php

namespace App\Entities;

trait NativeAttributeTrait
{
    public function GetNativeAttributeValue(string $attr)
    {
        return $this->{$attr . '_' . app()->getLocale()};
    }
}
