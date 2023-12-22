@extends('backend.layouts.master')
@section('main-content')
@section('title', 'Báo Cáo - Thống Kê')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-header" style="border-bottom: 10px solid #28a745 !important; ">
                    <h1 class="fw-semibold mb-4  text-dark">Report-Statistical</h1>
                </div>
                <div class="card-body">

                    <div class="row mb-5 ">
                        <div class="col-lg-8 ">
                            <div class="row ">
                                <div class="col-lg-4 align-self-center ">
                                    <h5>Từ Ngày: </h3>
                                </div>
                                <div class="col-lg-4 float-start">
                                    <input id="txtFilterDateFrom1" class="form-control d-inline-block" type="date"
                                        value="" min="">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var inputDate = document.getElementById('txtFilterDateFrom1');

                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            var currentDate = yyyy + '-' + mm + '-' + dd;

                                            inputDate.value = currentDate;
                                            inputDate.min = '2000-01-01'; // (Optional) Set the minimum selectable date if needed
                                        });
                                    </script>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-clock text-white fw-bold fs-13"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Ngày Mai</a></li>
                                            <li><a class="dropdown-item" href="#">Hôm Nay</a></li>
                                            <li><a class="dropdown-item" href="#">Ngày Hôm Qua</a></li>
                                            <li><a class="dropdown-item" href="#">Tuần Trước</a></li>
                                            <li><a class="dropdown-item" href="#">Tháng Trước</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 ">
                                <div class="col-lg-4 align-self-center">
                                    <h5>Đến Ngày: </h3>
                                </div>
                                <div class="col-lg-4 float-start">
                                    <input id="txtFilterDateFrom" class="form-control d-inline-block" type="date"
                                        value="" min="">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var inputDate = document.getElementById('txtFilterDateFrom');

                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            var currentDate = yyyy + '-' + mm + '-' + dd;

                                            inputDate.value = currentDate;
                                            inputDate.min = '2000-01-01'; // (Optional) Set the minimum selectable date if needed
                                        });
                                    </script>
                                </div>
                                <div class="col-lg-4">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <!-- Button trigger modal -->



                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover " id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày</th>
                                    {{-- <th>Suppliers</th> --}}
                                    <th>Sản Phẩm</th>
                                    <th>Tồn Đầu</th>
                                    <th>Nhập</th>
                                    <th>Xuất</th>
                                    <th>Tồn Cuối</th>
                                    <th>Tổng Tiền</th>
                                    <th>Nhân Viên</th>
                                   
                                    <th><input type="checkbox" class="select-all" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($stockindetail as $data)
                                    <tr data-expanded="true">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ date('d-m-Y', strtotime($data->stockin->CREATEDDATE)) }}
                                            <p>{{ date('H:i:s', strtotime($data->stockin->CREATEDDATE)) }}</p>
                                        </td>
                                        {{-- <td>{{ $data->stockin->supplier->NAME }}</td> --}}
                                        <td>{{ $data->product->NAME }}</td>
                                        <td>0</td>
                                        <td>{{ $data->QUANTITY }}</td>
                                        <td>25</td>
                                        <td>{{ $data->QUANTITY + 25 }} </td>
                                        {{-- <td>{{ $data->product->unit }}</td> --}}
                                        <td>{{ number_format($data->QUANTITY * $data->product->PRICE + 354543, 0, ',', '.') }}₫
                                        </td>
                                        <td>{{ $data->stockin->employee->LASTNAME }}
                                            {{ $data->stockin->employee->FIRSTNAME }}</td>
                                        {{-- <td>{{ number_format($data->PRICE, 0, ',', '.') }}₫</td>
                                        <td>{{ $data->unit }}</td>

                                        <td>
                                            @if ($data->category != null)
                                                {{ $data->category->NAME }}
                                            @else
                                                <p class="text-danger"> Chưa Có Danh Mục</p>
                                            @endif
                                        </td> --}}

                                      
                                        <td><input type="checkbox" class="select-row" /></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>




                </div>
            </div>
        </div>
    </div>

</div>

@endSection
