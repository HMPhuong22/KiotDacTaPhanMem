@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-SUPPLIER')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">LIST SUPPLIERS</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">

                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary float-end">+ ADD SUPLIER</a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Address </th>
                                    <th>PhoneNumber</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($supplier as $data)
                                    <tr class="text-center">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ $data->NAME }}</td>
                                        <td>{{ $data->ADDRESS }}</td>
                                        <td>
                                            {{ $data->PHONE }}
                                        </td>
                                        <td>
                                            <span class="d-flex">

                                                <a href="{{route('suppliers.show',['supplier'=>$data->SUPP_ID])}}" class="btn btn-success text-white me-1">Edit</a>
                                                <form action="{{route('suppliers.destroy',['supplier'=>$data->SUPP_ID])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-danger text-white" value="Delete"/>
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
