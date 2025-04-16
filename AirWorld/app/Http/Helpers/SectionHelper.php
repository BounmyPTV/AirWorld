<?php

namespace App\Http\Helpers;
use App\Http\Helpers\CardHelper;

class SectionHelper {
    private $sections = [];

    public function add_section(string $id, string|array $left, string|array $right) : void {
        $this->sections[] = CardHelper::card($id, $left, $right);
    }

    public function get(): array {
        return $this->sections;
    }
}