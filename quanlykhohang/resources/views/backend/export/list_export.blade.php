@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-PRODUCTS')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">Danh Sách Sản Phẩm</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">

                            <form action="">

                                <div class="d-flex">
                                    <input type="text" class="form-control"
                                        placeholder="Vui Lòng Nhập Từ Khóa Tìm Kiếm">

                                    <input type="submit" class="btn btn-success" value="Search">

                                </div>
                            </form>


                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('export.create') }}" class="btn btn-primary float-end">+ Xuất Kho
                                Phẩm</a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Kho Hàng</th>
                                    <th>Ngày Xuất</th>
                                    <th>Số Lượng</th>
                                    <th>Nhân Viên Xuất</th>
                                    <th>Công Cụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nho mỹ</td>
                                    <td>Thực Phẩm</td>
                                    <td>13/5/2023</td>

                                    <td>10</td>
                                    <td>Đặng Hồng Quân</td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="" class="btn btn-success text-white me-1">In Hóa Đơn</a>
                                            <a href="" class="btn btn-danger text-white">Delete</a>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Stting</td>
                                    <td>Nước Giải Khát</td>
                                    <td>25/5/2023</td>
                                    <td>20</td>
                                    <td>Trần Quang Đạt</td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="" class="btn btn-success text-white me-1">In Hóa Đơn</a>
                                            <a href="" class="btn btn-danger text-white">Delete</a>
                                        </span>

                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endSection
