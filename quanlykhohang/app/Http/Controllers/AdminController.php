<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stockindetail;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::all();
        $product = Product::all();
        $supplier = Supplier::all();
        $warehouse1 = Warehouse::all();
        $product1 = Product::all();
        $supplier1 = Supplier::all();
        $stockindetail1 = Stockindetail::with('stockin', 'product')->get();
        $stockindetail = Stockindetail::with('stockin', 'product')->get();
        return view('backend.index')->with('stockindetail', $stockindetail)->with('product', $product)->with('supplier', $supplier)->with('warehouse', $warehouse)->with('stockindetail1', $stockindetail1)->with('product1', $product1)->with('supplier1', $supplier1)->with('warehouse1', $warehouse1);
    }
    public function doanhthu()
    {
        return view('backend.dashboard');
    }
}
