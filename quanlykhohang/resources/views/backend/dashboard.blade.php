@extends('backend.layouts.master')
@section('main-content')
@section('title', 'DASHBOARD')
<!--  Row 1 -->
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Tổng quan về bán hàng</h5>
                    </div>
                    <div>
                        <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Doanh Thu Năm</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">1.200.500.708 VND</h4>
                                <div class="d-flex align-items-center mb-3">
                                   
                                   
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">2023</span>
                                    </div>
                                    <div>
                                        <span
                                            class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">2023</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div id="breakup"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Doanh Thu Tháng </h5>
                                <h4 class="fw-semibold mb-3">123.323.000 VND</h4>
                                <div class="d-flex align-items-center pb-1">
                                    
                                   
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div
                                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="earning"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection
