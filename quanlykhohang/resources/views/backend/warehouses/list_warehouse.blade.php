@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-EMPLOYEES')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">LIST WAREHOUSES</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">

                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('warehouse.create') }}" class="btn btn-primary float-end">+ ADD
                                WAREHOUSE</a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Warehouse Name</th>
                                    <th>Warehouse Address </th>
                                    <th>Manager</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($warehouse as $data)
                                    <tr class="text-center">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ $data->NAME }}</td>
                                        <td>{{ $data->ADDRESS }}</td>
                                        <td>
                                            <p>
                                                @if ($data->employee != null)
                                                    {{ $data->employee->LASTNAME }} {{ $data->employee->FIRSTNAME }}
                                                @else
                                                    <p class="text-danger fw-bold ">Chưa Có Quản Lý</p>
                                                @endif
                                            </p>


                                        </td>
                                        <td>
                                            <span class="d-flex">
                                                {{-- <a href="" class="btn btn-primary text-white me-1">List Products
                                                    in Warehouse</a> --}}
                                                <a href="{{ route('warehouse.show', ['warehouse' => $data->WAR_ID]) }}"
                                                    class="btn btn-success text-white me-1">Edit</a>
                                                <form
                                                    action="{{ route('warehouse.destroy', ['warehouse' => $data->WAR_ID]) }}"
                                                    method="post">
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
