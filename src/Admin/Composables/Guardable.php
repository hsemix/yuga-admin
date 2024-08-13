<?php

namespace Yuga\Admin\Composables;

use Yuga\Models\Auth;

trait Guardable 
{
    protected function guard()
    {
        return new Auth();
    }
}