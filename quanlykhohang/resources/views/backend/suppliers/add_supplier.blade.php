@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-Suppliers')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">ADD NEW SUPPLIER</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('suppliers.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Supplier Name <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="supplier" aria-describedby="khohang"
                                        placeholder="Nhập Tên Nhà Cung Cấp" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="diachi" class="form-label">Address<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="diachi" aria-describedby="khohang"
                                        placeholder="Nhập Địa Chỉ Nhà Cung Cấp" name="address">
                                </div>

                                <div class="mb-3">
                                    <label for="sdt" class="form-label">PhoneNumber <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="sdt" aria-describedby="khohang"
                                        placeholder="Nhập SDT Nhà Cung Cấp" name="phone">
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
