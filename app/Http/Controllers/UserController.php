<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\User;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
     //   dd($users);
        return view('user.index', compact('users'));
    }
    public function addView()
    {
        return view('user.create');
    }

    public function store(UserAddRequest $request)
    {
        if ($request->has('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = random_int(0001, 9999).'.'.$extension;
            $file_path = 'user/'.$file_name;
            Storage::disk('public')->put($file_path, file_get_contents($request->file('image')));
        } else {
            $file_path = null;
        }

        if (User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $file_name,
            'password' => Hash::make($request->password)
        ])) {
            return redirect('home')->with('success', 'User Saved');
        } else {
            return redirect()->back()->with('errors', 'User not saved');
        }
    }

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $is_exists = User::where('email', $email)->first();
        if (!$is_exists) {
            return true;
        } else {
            return false;
        }
    }

    public function edit(int $id)
    {
        $user = User::where('id', $id)->first();
        return view('user.edit', compact('user'));
    }

    public function update($id, UserEditRequest $request)
    {
        $user = User::where('id', $id)->first();
        if ($request->has('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = random_int(0001, 9999).'.'.$extension;
            $file_path = 'user/'.$file_name;
            if ($user->image) {
                Storage::disk('public')->delete('user/'.$user->image);
            }
            Storage::disk('public')->put($file_path, file_get_contents($request->file('image')));
        } else {
            $file_name = $user->image;
        }
        if (User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $file_name,
        ])) {
            return redirect('users')->with('success', 'User Updated');
        } else {
            return redirect()->back()->with('errors', 'User not saved');
        }
    }

    public function registerUser(UserAddRequest $request)
    {


        if (User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ])) {
            return redirect('/')->with('success', 'User Registered Sucessfully');
        } else {
            return redirect()->back()->with('errors', 'User not saved');
        }
    }
}
