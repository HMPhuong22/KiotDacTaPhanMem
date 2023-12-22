@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-PRODUCTS')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">Phiếu Xuất Sản Phẩm </h1>
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Chọn Sản Phẩm Cần Xuất</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Chọn Sản Phẩm</option>
                                        <option value="1">Stting</option>
                                        <option value="2">Nho Mỹ</option>
                                    </select>
                                </div>
                                <label for="exampleInputPassword1" class="form-label"> Số Lượng </label>
                                <input type="number" class="form-control" id="sl" placeholder="Nhập Số Lượng">


                                <h6 class="text-dark text-uppercase mb-4 mt-4 ">Thông Tin Về Khách Hàng <span
                                        class="text-danger">(*)</span> </h6>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên Khách Hàng <span
                                            class="text-danger">(*)</span> </label>

                                    <input type="text" class="form-control" id="tensp"
                                        aria-describedby="emailHelp" placeholder="Nhập Tên Khách Hàng">
                                </div>


                                <label for="exampleInputPassword1" class="form-label">Số Điện Thoại<span
                                        class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" id="donvi"
                                    placeholder="Nhập Đơn Vị Tính">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Địa Chỉ Khách Hàng <span
                                            class="text-danger">(*)</span> </label>

                                    <input type="text" class="form-control" id="tensp"
                                        aria-describedby="emailHelp" placeholder="Nhập Địa Chỉ Khách Hàng">
                                </div>


                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary">Xuất Kho</button>
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
