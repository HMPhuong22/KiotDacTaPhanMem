<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $warehouse = Employee::with('warehouse')->get();
        $employee = User::with('employee')->get();
        return view("backend.employees.list_employee")->with(['employee' => $employee],['warehouse' => $warehouse]);
        // return $employee;
    }
    public function create()
    {
        $warehouse = Warehouse::all();
        return view("backend.employees.add_employees")->with('warehouse', $warehouse);
    }
    //thêm dữ liệu
    public function store(Request $request)
    {


        // Nhận dữ liệu từ request
        $employeeData =  new Employee();
        $employeeData->war_id = $request->input('warid');
        $employeeData->lastName = $request->input('lastName');
        $employeeData->firstName = $request->input('firstName');
        $employeeData->birthday = $request->input('birthday');
        $employeeData->address = $request->input('address');
        $employeeData->phone = $request->input('phone');
        $employeeData->cccd = $request->input('cccd');
        $employeeData->position = $request->input('role');

        $userData = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role')
        ];

        // Tạo đối tượng Employee và lưu vào cơ sở dữ liệu

        $employeeData->save();
        $layid = $employeeData->EMP_ID;        // Mã hóa mật khẩu
        $hashedPassword = Hash::make($userData['password']);

        // Tạo đối tượng User và lưu vào cơ sở dữ liệu
        $user = new User([
            'username' => $userData['username'],
            'password' => $hashedPassword,
            'role' => $userData['role'],
            'EMP_ID' => $layid,
        ]);
        $user->save();

        // Các bước xử lý khác sau khi thêm dữ liệu

        return redirect()->route('employees.index')->with('message', 'Thêm nhân viên thành công');
    }
    public function show($employee)
    {
        $employee = Employee::find($employee);
        // $warehouse = Warehouse::WHERE('EMP_ID', $employee->EMP_ID)->first();
        $warehouse = Warehouse::all();
        $user = User::WHERE('EMP_ID', $employee->EMP_ID)->first();
        return view("backend.employees.edit_employee")->with('employee', $employee)->with('warehouse', $warehouse)->with('user', $user);
    }
    public function update(Request $request, $employee)
    {
        $employee = Employee::find($employee);
        $employee->WAR_ID = $request->input('warid');
        $employee->LASTNAME = $request->input('lastName');
        $employee->FIRSTNAME = $request->input('firstName');
        $employee->ADDRESS = $request->input('address');
        $employee->PHONE = $request->input('phone');
        $employee->BIRTHDAY = $request->input('birthday');
        $employee->CCCD = $request->input('cccd');
        $employee->position = $request->input('role');

        $user = User::WHERE('EMP_ID', $employee->$employee)->get();

        $layid = $employee->EMP_ID;
        $user->EMP_ID = $layid;
        $user->username = $request->input('username');
        $hashedPassword2 = Hash::make($request->input('password'));
        $user->password = $hashedPassword2;
        $user->ROLE = $request->input('role');

        $employee->save();
        foreach ($user as $model) {
            $model->save();
        }

        return redirect()->route('employees.index')->with('message', 'Cập Nhật Thành Công Một Nhân Viên');
    }

    public function destroy($employee)
    {
        $employe = Employee::findOrFail($employee);
        // Cập nhật các bản ghi liên quan trong bảng "Warehouse" and "User"
        Warehouse::where('WAR_ID', $employe->WAR_ID)->update(['WAR_ID' => $employe->WAR_ID]);
        User::where('EMP_ID', $employe->EMP_ID)->delete();


        $employe->delete();
        return redirect()->route('employees.index')->with('message', 'Xóa Thành Công Một Nhân Viên');
    }
}