@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-CATEGORY')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">LIST CATEGORYS</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">
                            {{-- 
                            <form action="">

                                <div class="d-flex">
                                    <input type="text" class="form-control"
                                        placeholder="Vui Lòng Nhập Từ Khóa Tìm Kiếm">

                                    <input type="submit" class="btn btn-success" value="Search">
                                    <select class="form-select" aria-label="Default select example"
                                        style="width: 300px">
                                        <option selected>Tìm Kiếm Theo</option>
                                        <option value="1">Tên</option>
                                        <option value="2">Só ĐT</option>
                                        <option value="3">CCCD</option>
                                    </select>
                                </div>
                            </form> --}}


                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('categorys.create') }}" class="btn btn-primary float-end">+ ADD
                                CATEGORYS</a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover display" id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>CategoryName</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php $dem = 1; ?>
                                @foreach ($category as $data)
                                    <tr data-expanded="true">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ $data->NAME }}</td>

                                        <td>
                                            <span class="d-flex">
                                                <a href="{{ route('categorys.show', ['category' => $data->CATE_ID]) }}"
                                                    class="btn btn-success text-white me-1">Edit</a>
                                                <form
                                                    action="{{ route('categorys.destroy', ['category' => $data->CATE_ID]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger text-white"
                                                        value="Delete" />
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
