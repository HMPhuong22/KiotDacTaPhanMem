@extends('backend.layouts.master')
@section('main-content')
@section('title', 'StockoutDetails')

<div class="container">
    <style>

    </style>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white fw-bold text-uppercase h3">
                    <i class="ti ti-shopping-cart"></i> Đơn Hàng - {{ $stockoutdetail->stockout->customer->NAME }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Tên Nhà Cung Cấp:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockoutdetail->stockout->customer->NAME }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Số Điện Thoại:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>0{{ $stockoutdetail->stockout->customer->PHONE }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Địa Chỉ:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockoutdetail->stockout->customer->ADDRESS }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase">
                            <p style="font-size: 16px; font-weight: bold;">Sản Phẩm XUẤT:</p>
                        </div>
                        <div class="col-lg-7">
                            <p>{{ $stockoutdetail->product->NAME }}</p>
                            <p style="margin-top: -23px; ">
                                {{ $stockoutdetail->QUANTITY }} <span style="font-size: 16px; font-weight: bold">x</span>
                                {{ number_format($stockoutdetail->product->PRICE, 0, ',', '.') }} <span
                                    style="font-size: 23px; font-weight: bold">=</span>
                                {{ number_format($stockoutdetail->QUANTITY * $stockoutdetail->product->PRICE, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 fw-bold text-uppercase text-success">
                            <p style="font-size: 16px; font-weight: bold;">Tổng Tiền:</p>
                        </div>
                        <div class="col-lg-7">
                            <p style="font-weight: bold; font-size: 23px">
                                {{ number_format($stockoutdetail->QUANTITY * $stockoutdetail->product->PRICE, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endSection
