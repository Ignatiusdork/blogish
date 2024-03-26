<?php

namespace App\Services;

// php interface helps define a contract that any implmentors of this interface must conform to it
interface Newsletter {
    public function subscribe(string $email, string $list = null);
}
