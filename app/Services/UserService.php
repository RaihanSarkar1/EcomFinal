<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class UserService
{
    public function roles()
    {
//        $roles = [
//            new Designer(),
//            new Programmer(),
//            new Hr()
//        ];
//        $name_array = [];
//        $position_array = [];
//        foreach ($roles as $role) {
//            array_push($name_array, $role->setName());
//            array_push($position_array, $role->setPosition());
//        }
        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();
        dd($roles);
    }
}
