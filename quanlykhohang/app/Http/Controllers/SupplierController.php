<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return view('backend.suppliers.list_supplier')->with('supplier', $supplier);
    }
    public function create()
    {
        return view('backend.suppliers.add_supplier');
    }

    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->NAME = $request->input('name');
        $supplier->ADDRESS = $request->input('address');
        $supplier->PHONE = $request->input('phone');
        $supplier->save();
        return redirect()->route('suppliers.index')->with('message', "Thêm Thành Công Nhà Cung Cấp");
    }
    public function show($supplier){
        $supplier=Supplier::find($supplier);
        return view('backend.suppliers.edit_supplier')->with('supplier', $supplier);
    }
    public function update(Request $request, $supplier){
        $supplier=Supplier::find($supplier);
        $supplier->NAME=$request->input('name');
        $supplier->ADDRESS=$request->input('address');
        $supplier->PHONE = $request->input('phone');
        $supplier->save();
        return redirect()->route('suppliers.index')->with('message', "Cập Nhật Thành Công Nhà Cung Cấp");
    }
    public function destroy($supplier){
        $supplier=Supplier::find($supplier);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('message', "Xóa Thành Công Nhà Cung Cấp");
        
    }
}