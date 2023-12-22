@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-Category')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">EDIT CATEGORY</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('categorys.update', ['category' => $category->CATE_ID]) }}"
                                method="POST">
                                @method('PUT')
                                @csrf

                                <div class="mb-3">
                                    <label for="tendanhmuc" class="form-label">Category Name <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="tendanhmuc"
                                        aria-describedby="khohang" placeholder="Nhập Tên Danh Mục" name="name"
                                        value="{{ $category->NAME }}">
                                </div>


                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary">Update Category</button>
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
