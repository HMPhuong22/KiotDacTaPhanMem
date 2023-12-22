@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-PRODUCTS')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">LIST PRODUCTS</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">
                            {{-- 
                            <form action="">

                                <div class="d-flex">
                                    <input type="text" class="form-control"
                                        placeholder="Vui Lòng Nhập Từ Khóa Tìm Kiếm">

                                    <input type="submit" class="btn btn-success" value="Search">

                                </div>
                            </form> --}}


                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('products.create') }}" class="btn btn-primary float-end">+ ADD PRODUCT
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover " id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Product Unit</th>
                                    <th>Category</th>
                                    <th>Settings</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($product as $data)
                                    <tr data-expanded="true" >
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ $data->NAME }}</td>
                                        <td>{{ number_format($data->PRICE, 0, ',', '.') }}₫</td>
                                        <td>{{ $data->unit }}</td>

                                        <td>
                                            @if ($data->category != null)
                                                {{ $data->category->NAME }}
                                            @else
                                                <p class="text-danger"> Chưa Có Danh Mục</p>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="d-flex">
                                                <a href="{{ route('products.show', ['product' => $data->PRO_ID]) }}"
                                                    class="btn btn-success text-white me-1">Edit</a>
                                                <form
                                                    action="{{ route('products.destroy', ['product' => $data->PRO_ID]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="text-white fw-bold btn btn-danger"
                                                        value="Delete">
                                                </form>
                                            </span>

                                        </td>
                                      
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
