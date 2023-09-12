<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryAddRequest;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    function manageCategories() {

        $categories = Category::get();
        return view('product.category', compact('categories'));
    }

    function addCategory(CategoryAddRequest $request) {
        $name = $request->name;

        Category::insert([
            'name' => $name,
        ]);

        return redirect('manage_categories');
    }

    function deleteCategory($id) {
        Category::find($id)->delete();
        return redirect('manage_categories');
    }

    function editCategory($id) {
        $item = Category::find($id);
        return view('product.edit_category', compact('item'));


    }

    function updateCategory($id, CategoryAddRequest $request) {
        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect('manage_categories');
    }
}
