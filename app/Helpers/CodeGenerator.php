<?php

namespace App\Helpers;

class CodeGenerator
{
    /**
     * @return string
     */
    public function generate(): string
    {
        $alphanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $shuffle = str_shuffle($alphanumeric);

        return substr($shuffle, 0, 6);
    }
}
