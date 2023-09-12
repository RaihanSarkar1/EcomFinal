<?php

namespace App\Services;

use App\Interfaces\Member;

class Programmer implements Member
{
    public function setPosition()
    {
        return 'My position is programmer';
    }

    public function setName()
    {
        return 'My Name is programmer';
    }
}
