<?php

namespace App\Http\Helpers;

class CardHelper {
    public static function card(string $id, string|array $left, string|array $right) : array {
        return compact("id","left","right");
    }
}