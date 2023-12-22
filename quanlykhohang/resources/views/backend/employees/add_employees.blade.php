@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-EMPLOYEES')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">ADD NEW EMPLOYEE</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('employees.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="lastName" class="form-label">LastName<span
                                                class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="honv"
                                            placeholder="Nhập Họ Của Nhân Viên" name="lastName">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="firstName" class="form-label">FirstName <span
                                                class="text-danger">(*)</span> </label>
                                        <input type="text" class="form-control" id="tennv"
                                            placeholder="Nhập Tên Của Nhân Viên" name="firstName">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address <span
                                            class="text-danger">(*)</span> </label>

                                    <input type="text" class="form-control" id="tensp"
                                        aria-describedby="emailHelp" placeholder="Nhập Địa Chỉ Nhân Viên"
                                        name="address">
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="phone" class="form-label">PhoneNumber<span
                                                class="text-danger">(*)</span></label>
                                        <input type="number" class="form-control" id="sdt"
                                            placeholder="Nhập Số Điện Thoại Nhân Viên" name="phone">
                                    </div>
                                    <div class="col-lg-6 align-content-center">
                                        <label for="cccd" class="form-label">CCCD<span
                                                class="text-danger">(*)</span></label>
                                        <input type="number" class="form-control" id="sdt"
                                            placeholder="Nhập Số Căn Cước Công Dân " name="cccd">
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">UserName: <span
                                            class="text-danger">(*)</span> </label>

                                    <input type="text" class="form-control" id="username"
                                        aria-describedby="usernameHelp" placeholder="Tài Khoản Đăng Nhập"
                                        name="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password: <span
                                            class="text-danger">(*)</span> </label>

                                    <input type="password" class="form-control" id="password"
                                        aria-describedby="password" placeholder="Nhập PassWord" name="password">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="birthday" class="form-label">Birthday </label>
                                        <input type="date" class="form-control" id="birthday" name="birthday">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="password" class="form-label">Employee Manager <span
                                                class="text-danger">(*)</span> </label>
                                        <select class="form-select" aria-label="Default select example" name="warid">
                                            <option selected>------Chọn Kho Quản Lý------</option>
                                            <option value="0">Không Quản Lý Kho Nào</option>
                                            @foreach ($warehouse as $option)
                                                <option value="{{ $option->WAR_ID }}">{{ $option->NAME }}</option>
                                            @endForeach
                                        </select>
                                    </div>



                                    <label for="role" class="form-label">Role Employee <span
                                            class="text-danger">(*)</span></label>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="role" id="role1"
                                            value="user">
                                        <label class="form-check-label" for="role1">
                                             User
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2"
                                            value="admin">
                                        <label class="form-check-label" for="role2">
                                            admin
                                        </label>
                                    </div>




                                    <div class="text-center">

                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endSection
