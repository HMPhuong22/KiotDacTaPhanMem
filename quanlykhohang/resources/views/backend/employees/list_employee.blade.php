@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-EMPLOYEES')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">LIST EMPLOYEES</h1>
                    <div class="row mb-5">
                        <div class="col-lg-8">

                            {{-- <form action="">

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
                            <a href="{{ route('employees.create') }}" class="btn btn-primary float-end">+ ADD
                                EMPLOYEE</a>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover display" id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>LastName</th>
                                    <th>FirstName</th>
                                    <th>Manager Warehouse</th>
                                    <th>PhoneNumber</th>
                                    <th>Address</th>
                                    <th>CCCD</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($employee as $data)
                                    <tr data-expanded="true">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ $data->employee->LASTNAME }}</td>
                                        <td>{{ $data->employee->FIRSTNAME }}</td>
                                        <td>
                                            @if ($data->employee->WAR_ID != null)
                                                {{ $data->employee->warehouse->NAME }}
                                            @else
                                                <p class="text-danger fw-bold"> Không Làm Quản Lý</p>
                                            @endif
                                        </td>
                                        <td>{{ $data->employee->PHONE }}</td>
                                        <td>{{ $data->employee->ADDRESS }}</td>
                                        <td>{{ $data->employee->CCCD }}</td>
                                        <td>
                                            <span class="d-flex">
                                                <a href="{{ route('employees.show', ['employee' => $data->employee->EMP_ID]) }}"
                                                    class="btn btn-success text-white me-1">Edit</a>
                                                <form
                                                    action="{{ route('employees.destroy', ['employee' => $data->employee->EMP_ID]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</a>
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

{{-- phần scirpt chỉnh table có nút check --}}
<script>
    $(document).ready(function() {
        $('#myTable tbody').on('change', '.select-row', function() {
            var isChecked = $(this).prop('checked');
            var row = $(this).closest('tr');

            if (isChecked) {
                row.addClass('selected-row');
            } else {
                row.removeClass('selected-row');
            }

            updateSelectAllCheckbox();
        });

        $('.select-all').on('change', function() {
            var isChecked = $(this).prop('checked');

            $('.select-row').prop('checked', isChecked);
            $('#myTable tbody tr').toggleClass('selected-row', isChecked);
        });

        function updateSelectAllCheckbox() {
            var allSelected = $('.select-row:checked').length === $('.select-row').length;
            $('.select-all').prop('checked', allSelected);
        }
    });
</script>
@endSection
