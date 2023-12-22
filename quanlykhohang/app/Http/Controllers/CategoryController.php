<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('backend.categorys.list_category')->with('category', $category);
    }
    public function create()
    {

        return view('backend.categorys.add_category');
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->NAME = $request->input('name');
        $category->save();
        // return view('backend.categorys.list_category');
        return Redirect::to("admin/categorys")->with('message', "Thêm Thành Công Một Danh Mục ");
    }

    public function show($category)
    {
        $category = Category::find($category);
        return view('backend.categorys.edit_category')->with('category', $category);
    }
    public function update(Request $request, $category)
    {
        $category = Category::find($category);
        $category->NAME = $request->input('name');
        $category->save();
        return Redirect::to("admin/categorys")->with('message', "Cập Nhật Thành Công Danh Mục");
    }
    public function destroy($category)
    {
        $category = Category::findOrFail($category);

        // Cập nhật các bản ghi liên quan trong bảng "products"
        Product::where('CATE_ID', $category->CATE_ID)->update(['CATE_ID' => null]);

        // Xóa danh mục (category)
        $category->delete();
        return Redirect::to("admin/categorys")->with('message', "Xóa Thành Công Danh Mục");
    }
}
