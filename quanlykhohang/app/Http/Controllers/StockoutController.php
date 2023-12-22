<?php

namespace App\Http\Controllers;

use App\Models\Stockout;
use App\Http\Requests\StoreStockoutRequest;
use App\Http\Requests\UpdateStockoutRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Stockoutdetail;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StockoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouse = Warehouse::all();
        $product = Product::all();
        $customer = Customer::all();
        $warehouse1 = Warehouse::all();
        $product1 = Product::all();
        $customer1 = Customer::all();
        $stockoutdetail1 = Stockoutdetail::with('stockout', 'product')->get();
        $stockoutdetail = Stockoutdetail::with('stockout', 'product')->get();
        return view('backend.stockouts.list_stockout')->with('stockoutdetail', $stockoutdetail)->with('product', $product)->with('customer', $customer)->with('warehouse', $warehouse)->with('stockoutdetail1', $stockoutdetail1)->with('product1', $product1)->with('customer1', $customer1)->with('warehouse1', $warehouse1);
    }
    //từ ajax gửi tới để lấy thông tin khách hàng
    public function getCustomer(Request $request)
    {
        // Lấy supplierId từ request
        $CustomerId = $request->input('customerId');
        $customer = Customer::find($CustomerId);

        // Xử lý logic của bạn để lấy dữ liệu tương ứng từ supplierId
        $response = [
            'name' => $customer->NAME,
            'address' => $customer->ADDRESS,
            'phone' => $customer->PHONE,

        ];
        // Trả về dữ liệu
        return response()->json($response);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $stockout = new Stockout();
        $stockout->WAR_ID = $request->input('warehouse');
        $stockout->CUS_ID = $request->input('customer');
        $user = Auth::user();
        $userID = $user->id;

        $employee = Employee::whereHas('user', function ($query) use ($userID) {
            $query->where('id', $userID);
        })->first();
        $stockout->EMP_ID = $employee->EMP_ID;
        $stockout->CREATEDDATE = now();
        $stockout->save();
        $stockoutdetail = new Stockoutdetail();
        $stockoutdetail->STOUT_ID = $stockout->getKey();
        $stockoutdetail->PRO_ID = $request->input('product');
        $stockoutdetail->QUANTITY = $request->input('quantity');
        // $giane = str_replace(',', '', $request->input("totalPrice"));
        // $stockindetail->totalPrice =  $request->input("totalPrice");
        $stockoutdetail->save();
        return Redirect::to("admin/stockouts")->with('message', " Lưu Thành Công ");
    }

    /**
     * Display the specified resource.
     */
    public function show($stockout)
    {
        $stockoutdetail = Stockoutdetail::with('stockout', 'product')->find($stockout);
        return view("backend.stockouts.show_stockoutdetail")->with('stockoutdetail', $stockoutdetail);
    }

    public function Editstockouts($id)
    {
        // Xử lý yêu cầu AJAX và trả về dữ liệu tương ứng
        $stockoutdetail = Stockoutdetail::with('stockout', 'product')->find($id);

        $response = [
            'customerName' => $stockoutdetail->stockout->customer->NAME,
            'customerAddress' => $stockoutdetail->stockout->customer->ADDRESS,
            'customerPhone' => $stockoutdetail->stockout->customer->PHONE,
            // 'address' => $supplier->ADDRESS,
            // 'phone' => $supplier->PHONE,

        ];
        // Trả về dữ liệu
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockout $stockout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$stockout)
    {
 //
 
 $stockouts = Stockout::where('STOUT_ID',Stockoutdetail::find($stockout)->STOUT_ID)->first();
 $stockouts->WAR_ID = $request->input('warehouse1');
 $stockouts->CUS_ID = $request->input('customer1');
 $user = Auth::user();
 $userID = $user->id;
 $employee = Employee::whereHas('user', function ($query) use ($userID) {
     $query->where('id', $userID);
 })->first();
 $stockouts->EMP_ID = $employee->EMP_ID;
 $stockouts->CREATEDDATE = now();
 $stockouts->save();
 $stockoutdetail = Stockoutdetail::find($stockout);
 $stockoutdetail->STOUT_ID = $stockouts->getKey();
 $stockoutdetail->PRO_ID = $request->input('product1');
 $stockoutdetail->QUANTITY = $request->input('quantity1');
 // $giane = str_replace(',', '', $request->input("totalPrice"));
 // $stockindetail->totalPrice =  $request->input("totalPrice");
 $stockoutdetail->save();
 return Redirect::to("admin/stockouts")->with('message', " Lưu Thành Công ");
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stockout $stockout)
    {
        //
    }
}