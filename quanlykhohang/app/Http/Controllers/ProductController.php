<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
   public function index()
   {
      $product = Product::with('category')->get();
      return view('backend.products.list_product')->with(['product' => $product]);
   }
   public function create()
   {
      $category = Category::all();
      return view('backend.products.add_product')->with('category', $category);
   }
   public function store(Request $request)
   {
      $product = new Product();
      if ($request->input('category') != null) {
         if (is_numeric($request->input('category'))) {
            $product->CATE_ID = $request->input('category');
         } else {
            // Gán giá trị mặc định hoặc null cho CATE_ID nếu không phải số
            $product->CATE_ID = null; // hoặc $product->CATE_ID = null;
         }
      } else {
         $product->CATE_ID = "";
      }


      $product->NAME = $request->input('name');
      $giane = str_replace(',', '', $request->input("price"));
      $product->PRICE = $giane;
      $product->UNIT = $request->input('unit');
      $product->create_at=now();
      $product->save();
      // return view('backend.products.list_product');
      return Redirect::to("admin/products")->with('message', " Thêm Thành Công Một Sản Phẩm");
   }
   public function show($product)
   {
      $product = Product::find($product);
      $category = Category::all();
      return view('backend.products.edit_product')->with('product', $product)->with('category', $category);
   }
   public function update(Request $request, $product)
   {
      $product = Product::find($product);
      if ($request->input('category') != null) {
         if (is_numeric($request->input('category'))) {
            $product->CATE_ID = $request->input('category');
         } else {
            // Gán giá trị mặc định hoặc null cho CATE_ID nếu không phải số
            $product->CATE_ID = null; // hoặc $product->CATE_ID = null;
         }
      } else {
         $product->CATE_ID = "";
      }
      $product->NAME = $request->input('name');
      $giane = str_replace(',', '', $request->input("price"));
      $product->PRICE = $giane;
      $product->UNIT = $request->input('unit');
      $product->save();
      return Redirect::to("admin/products")->with('message', " Cập Nhật Thành Công Một Sản Phẩm");
   }
   public function destroy($product)
   {
      $product = Product::find($product);

      $product->delete();
      return Redirect::to("admin/products")->with('message', " Xóa Thành Công Một Sản Phẩm");
   }
}