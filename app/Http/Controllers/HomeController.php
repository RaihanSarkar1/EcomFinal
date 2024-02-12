<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Product;
use App\Category;


class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function viewAdmin()
    {
        return view('dashboard');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator->errors());
        }
        // dd(Hash::make('welcome123'));
        $email = $request->email;
        $password = $request->password;
        // dd($email, $password);
        //        $user = User::where('email', $email)->first();
        //        if (password_verify($password, $user->password)) {
        //            return redirect('home');
        //        } else {
        //            return redirect('login');
        //        }
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $role = Auth::user()->role;
            if ($role == '1') {
                return redirect('admin');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('login');
        }
    }

    public function roles()
    {
        $service = new UserService();
        dd($service->roles());
    }

    public function viewHome()
    {
        return view('dashboard');
    }

    public function logout()
    {
        \request()->session()->flush();
        return redirect('/');
    }

    public function viewChangePassword()
    {
        return view('change_password');
    }

    public function changePassword(PasswordChangeRequest $request)
    {
        $data = $request->validated();
        $current_password = $data['current_password'];
        $confirm_password = $data['confirm_password'];
        $user = User::where('id', Auth::id())->first();
        if (password_verify($current_password, $user->password)) {
            //            User::where('id', Auth::id())
            //                ->update([
            //                    'password' => Hash::make($confirm_password)
            //                ]);
            DB::table('users')
                ->where('id', '=', Auth::id())
                ->update([
                    'password' => Hash::make($confirm_password)
                ]);
            return $this->logout();
        } else {
            return redirect()->back()->with('error', 'Password does not match!');
        }
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        return view('home.product_details', compact('product', 'categories'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $categories = Category::get();
        $products = DB::table('products')
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->where('category_id', '=', $id)
            ->paginate(4);
        return view('home.category', compact('products', 'categories', 'category'));
    }

    public function shop()
    {
        $categories = Category::get();
        $products = Product::paginate(4);
        return view('home.category', compact('products', 'categories'));
    }
}
