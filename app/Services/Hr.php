<?php

namespace App\Services;

use App\Interfaces\Member;

class Hr implements Member
{
    public function setPosition()
    {
        return 'My position is Hr';
    }

    public function setName()
    {
        return 'My Name is Hr';
    }
}
