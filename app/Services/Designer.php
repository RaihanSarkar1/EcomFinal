<?php

namespace App\Services;

use App\Interfaces\Member;

class Designer implements Member
{
    public function setPosition()
    {
        return 'My position is designer';
    }

    public function setName()
    {
        return 'My Name is designer';
    }
}
