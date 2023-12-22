@extends('backend.layouts.master')
@section('main-content')
@section('title', 'StockinDetails')

<div class="container">
    <style>

    </style>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white fw-bold text-uppercase h3">
                    <i class="ti ti-shopping-cart"></i> Đơn Hàng - {{ $stockindetail->stockin->supplier->NAME }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Tên Nhà Cung Cấp:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockindetail->stockin->supplier->NAME }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Số Điện Thoại:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>0{{ $stockindetail->stockin->supplier->PHONE }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Địa Chỉ:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockindetail->stockin->supplier->ADDRESS }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Sản Phẩm Nhập:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockindetail->product->NAME }}</p>
                            <p style="margin-top: -23px; ">
                                {{ $stockindetail->QUANTITY }} <span style="font-size: 16px; font-weight: bold">x</span>
                                {{ number_format($stockindetail->product->PRICE, 0, ',', '.') }} <span
                                    style="font-size: 23px; font-weight: bold">=</span>
                                {{ number_format($stockindetail->QUANTITY * $stockindetail->product->PRICE, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase text-success">
                            <p style="font-size: 16px; font-weight: bold;">Tổng Tiền:</p>
                        </div>
                        <div class="col-lg-7">
                            <p style="font-weight: bold; font-size: 23px">
                                {{ number_format($stockindetail->QUANTITY * $stockindetail->product->PRICE, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endSection
