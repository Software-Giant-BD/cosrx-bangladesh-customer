<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class GuidHelper
{
    public static function generate()
    {
        return Uuid::uuid4()->toString();
    }
}
