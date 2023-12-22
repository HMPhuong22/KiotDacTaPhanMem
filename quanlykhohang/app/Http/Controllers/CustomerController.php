<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(){
        
        $customer= Customer::all();
        return view('backend.customers.list_customer')->with('customer', $customer);
    }
    public function create()
    {
        return view('backend.customers.add_customer');
    }
    //từ ajax gửi tới để lấy thông tin của khách hàng
    public function getCustomer()
{
    
}
    public function store(Request $request)
    {
        $supplier = new Customer();
        $supplier->NAME = $request->input('name');
        $supplier->ADDRESS = $request->input('address');
        $supplier->PHONE = $request->input('phone');
        $supplier->save();
        return redirect()->route('customers.index')->with('message', "Thêm Thành Công Khách Hàng");
    }
    public function show($customer){
        $customer=Customer::find($customer);
        return view('backend.customers.edit_customer')->with('customer', $customer);
    }
    public function update(Request $request, $customer){
        $supplier=Customer::find($customer);
        $supplier->NAME=$request->input('name');
        $supplier->ADDRESS=$request->input('address');
        $supplier->PHONE = $request->input('phone');
        $supplier->save();
        return redirect()->route('customers.index')->with('message', "Cập Nhật Thành Công Khách Hàng");
    }
    public function destroy($customer){
        $supplier=Customer::find($customer);
        $supplier->delete();
        return redirect()->route('customers.index')->with('message', "Xóa Thành Công Khách Hàng");
        
    }
}