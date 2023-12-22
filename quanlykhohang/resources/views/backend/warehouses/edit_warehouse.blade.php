@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-WAREHOUSE')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">EDIT WAREHOUSE</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('warehouse.update',['warehouse'=>$warehouse->WAR_ID]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Warehouse Name <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="tenkho" aria-describedby="khohang"
                                        placeholder="Nhập Tên Kho Hàng" name="name" value="{{$warehouse->NAME}}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="tenkho" aria-describedby="khohang"
                                        placeholder="Nhập Địa Chỉ Kho Hàng" name="address" value="{{$warehouse->ADDRESS}}">
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
