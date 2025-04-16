<?php

namespace App\Http\Helpers;

class ImgHelper {
    public static function img_section(string|int $pos) : string {
        return "images/$pos.png";
    }
}