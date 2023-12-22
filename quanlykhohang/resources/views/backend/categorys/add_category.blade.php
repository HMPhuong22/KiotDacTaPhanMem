@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-Category')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">ADD NEW CATEGORY</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('categorys.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="tendanhmuc" class="form-label">Category Name <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="tendanhmuc" aria-describedby="khohang"
                                        placeholder="Nhập Tên Danh Mục" name="name">
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
