<?php

namespace App\Models;

use App\Core\Model;

class Company extends Model
{
    protected static string $table = 'companies';

    public static function generateAvatar(string $name): string
    {
        $encodedName = urlencode($name);

        return "https://ui-avatars.com/api/?name={$encodedName}&background=random&color=fff";
    }
}
