<?php

namespace App\Http\Controllers;

use App\Models\Stockin;
use App\Http\Requests\StoreStockinRequest;
use App\Http\Requests\UpdateStockinRequest;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Stockindetail;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StockinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('backend.stockins.list_stockin')->with('stockindetail', $stockindetail)->with('product', $product)->with('supplier', $supplier)->with('warehouse', $warehouse)->with('stockindetail1', $stockindetail1)->with('product1', $product1)->with('supplier1', $supplier1)->with('warehouse1', $warehouse1);
    }
    //bắt đầu lấy dữ liệu gọi từ ajax hiển thị sản phẩm
    public function searchProduct(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');
    
        // Xử lý logic để tìm kiếm sản phẩm dựa trên $searchKeyword
    
        // Ví dụ: Tìm kiếm sản phẩm từ cơ sở dữ liệu
        $products = Product::where('name', 'like', '%' . $searchKeyword . '%')->get();
    
        // Chuẩn bị dữ liệu trả về dưới dạng JSON
        $response = [];
    
        foreach ($products as $product) {
            $response[] = [
                'PRO_ID' => $product->PRO_ID,
                'CATE_ID' => $product->CATE_ID,
                'NAME' => $product->NAME,
                'PRICE' => $product->PRICE,
                'unit' => $product->unit,
                'create_at' => $product->created_at
            ];
        }
    
        return response()->json($response);
    }
    //bắt đầu lấy dữ liệu từ ajax lấy dữ liệu nha cung cấp

    public function getSupplier(Request $request)
    {
        // Lấy supplierId từ request
        $supplierId = $request->input('supplierId');
        $supplier = Supplier::find($supplierId);

        // Xử lý logic của bạn để lấy dữ liệu tương ứng từ supplierId
        $response = [
            'name' => $supplier->NAME,
            'address' => $supplier->ADDRESS,
            'phone' => $supplier->PHONE,

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
        $stockin = new Stockin();
        $stockin->WAR_ID = $request->input('warehouse');
        $stockin->SUPP_ID = $request->input('supplier');
        $user = Auth::user();
        $userID = $user->id;
        $employee = Employee::whereHas('user', function ($query) use ($userID) {
            $query->where('id', $userID);
        })->first();
        $stockin->EMP_ID = $employee->EMP_ID;
        $stockin->CREATEDDATE = now();
        $stockin->save();
        $stockindetail = new Stockindetail();
        $stockindetail->STIN_ID = $stockin->getKey();
        $stockindetail->PRO_ID = $request->input('product');
        $stockindetail->QUANTITY = $request->input('quantity');
        // $stockindetail->totalPrice=$request->input('totalPrice');
        $giane = str_replace(',', '', $request->input("totalPrice"));
        $stockindetail->totalPrice =  $giane;
        $stockindetail->save();
        return Redirect::to("admin/stockins")->with('message', " Lưu Thành Công ");
    }

    /**
     * Display the specified resource.
     */
    public function show($stockin)
    {
        $stockindetail = Stockindetail::with('stockin', 'product')->find($stockin);
        return view("backend.stockins.show_stockindetail")->with('stockindetail', $stockindetail);
    }
    public function Editstockins($id)
    {
        // Xử lý yêu cầu AJAX và trả về dữ liệu tương ứng
        $stockindetail = Stockindetail::with('stockin', 'product')->find($id);

        $response = [
            'supplierName' => $stockindetail->stockin->supplier->NAME,
            'supplierAddress' => $stockindetail->stockin->supplier->ADDRESS,
            'supplierPhone' => $stockindetail->stockin->supplier->PHONE,
            // 'address' => $supplier->ADDRESS,
            // 'phone' => $supplier->PHONE,

        ];
        // Trả về dữ liệu
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockin $stockin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$stockin)
    {
 //
 
 $stockins = Stockin::where('STIN_ID',Stockindetail::find($stockin)->STIN_ID)->first();
 $stockins->WAR_ID = $request->input('warehouse1');
 $stockins->SUPP_ID = $request->input('supplier1');
 $user = Auth::user();
 $userID = $user->id;
 $employee = Employee::whereHas('user', function ($query) use ($userID) {
     $query->where('id', $userID);
 })->first();
 $stockins->EMP_ID = $employee->EMP_ID;
 $stockins->CREATEDDATE = now();
 $stockins->save();
 $stockindetail = Stockindetail::find($stockin);
 $stockindetail->STIN_ID = $stockins->getKey();
 $stockindetail->PRO_ID = $request->input('product1');
 $stockindetail->QUANTITY = $request->input('quantity1');
 // $giane = str_replace(',', '', $request->input("totalPrice"));
 // $stockindetail->totalPrice =  $request->input("totalPrice");
 $stockindetail->save();
 return Redirect::to("admin/stockins")->with('message', " Lưu Thành Công ");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stockin $stockin)
    {
        //
    }
}