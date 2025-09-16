<?php

namespace App\InfrastructureProviders\Internal;

use Illuminate\Support\Facades\Hash;

class CipherClient
{
    public static function hash(string $plainText)
    {
        return Hash::make($plainText);
    }

    public static function verify(string $plainText, string $hash)
    {
        return Hash::check($plainText, $hash);
    }
}
