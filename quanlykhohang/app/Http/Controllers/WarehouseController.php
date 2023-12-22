<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::with('employee')->get();
        // $warehouse = Employee::with('warehouse')->get();
        return view('backend.warehouses.list_warehouse')->with(['warehouse' => $warehouse]);
        // return $warehouse;
    }
    public function create()
    {
        return view('backend.warehouses.add_warehouse');
    }
    public function store(Request $request)
    {
        $warehouse = new Warehouse();
        $warehouse->NAME = $request->input('name');
        $warehouse->ADDRESS = $request->input('address');
        $warehouse->save();
        return redirect()->route('warehouse.index')->with('message', "Thêm Thành Công Kho Hàng");
    }
    public function show($warehouse)
    {
        $warehouse = Warehouse::find($warehouse);
        return view('backend.warehouses.edit_warehouse')->with(['warehouse' => $warehouse]);
    }

    public function update(Request $request, $warehouse)
    {
        $warehouse = Warehouse::find($warehouse);
        $warehouse->NAME = $request->input('name');
        $warehouse->ADDRESS = $request->input('address');
        $warehouse->save();
        return redirect()->route('warehouse.index')->with('message', "Cập Nhật Thành Công Kho Hàng");
    }
    public function destroy($warehouse)
    {
        $warehouse = Warehouse::find($warehouse);
        // Cập nhật các bản ghi liên quan trong bảng "products"
        Employee::where('WAR_ID', $warehouse->WAR_ID)->update(['WAR_ID' => null]);
        $warehouse->delete();
        return redirect()->route('warehouse.index')->with('message', "Xóa Thành Công Kho Hàng");
    }
}
