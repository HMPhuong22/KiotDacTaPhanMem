@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-PRODUCTS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-header" style="border-bottom: 10px solid #28a745 !important; ">
                    <h1 class="fw-semibold mb-4  text-dark">LIST STOCKIN</h1>
                </div>
                <div class="card-body">

                    <div class="row mb-5 ">
                        <div class="col-lg-8 ">
                            <div class="row ">
                                <div class="col-lg-4 align-self-center ">
                                    <h5>Từ Ngày: </h3>
                                </div>
                                <div class="col-lg-4 float-start">
                                    <input id="txtFilterDateFrom1" class="form-control d-inline-block" type="date"
                                        value="" min="">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var inputDate = document.getElementById('txtFilterDateFrom1');

                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            var currentDate = yyyy + '-' + mm + '-' + dd;

                                            inputDate.value = currentDate;
                                            inputDate.min = '2000-01-01'; // (Optional) Set the minimum selectable date if needed
                                        });
                                    </script>
                                </div>
                                <div class="col-lg-4">
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-clock text-white fw-bold fs-13"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Ngày Mai</a></li>
                                            <li><a class="dropdown-item" href="#">Hôm Nay</a></li>
                                            <li><a class="dropdown-item" href="#">Ngày Hôm Qua</a></li>
                                            <li><a class="dropdown-item" href="#">Tuần Trước</a></li>
                                            <li><a class="dropdown-item" href="#">Tháng Trước</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 ">
                                <div class="col-lg-4 align-self-center">
                                    <h5>Đến Ngày: </h3>
                                </div>
                                <div class="col-lg-4 float-start">
                                    <input id="txtFilterDateFrom" class="form-control d-inline-block" type="date"
                                        value="" min="">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var inputDate = document.getElementById('txtFilterDateFrom');

                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            var currentDate = yyyy + '-' + mm + '-' + dd;

                                            inputDate.value = currentDate;
                                            inputDate.min = '2000-01-01'; // (Optional) Set the minimum selectable date if needed
                                        });
                                    </script>
                                </div>
                                <div class="col-lg-4">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{-- <a href="{{ route('stockins.create') }}" class="btn btn-primary float-end">+ ADD Stockin
                            </a> --}}
                            <button type="button" class="btn float-end text-white fw-bold hover" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" style="background-color: #28a745  !important; ">
                                + ADD Stockin
                            </button>
                        </div>
                        <!-- Button trigger modal -->


                        <!-- Modal  dành cho thêm mới -->

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <form action="{{ route('stockins.store') }}" method="post">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <i class="ti ti-info-circle h1"></i>
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"> New Stockin</h1>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <select class="form-select supplierSelect"
                                                                aria-label="Default select example" name="supplier">
                                                                <option selected>---Please choose a supplier---
                                                                </option>
                                                                @foreach ($supplier as $supplier)
                                                                    <option value="{{ $supplier->SUPP_ID }}">
                                                                        {{ $supplier->NAME }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <select class="form-select "
                                                                aria-label="Default select example" name="warehouse">
                                                                <option selected>---Please choose a Warehouse---
                                                                </option>
                                                                @foreach ($warehouse as $warehouse)
                                                                    <option value="{{ $warehouse->WAR_ID }}">
                                                                        {{ $warehouse->NAME }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label for="">Supplier Name </label>
                                                                    <input type="text" class=" form-control "
                                                                        name="supplier" id="supplierName" disabled>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label for="">PhoneNumber </label>
                                                                    <input type="text" class=" form-control "
                                                                        name="supplier" id="supplierPhone" disabled>
                                                                </div>
                                                            </div>
                                                            <label for="">Address </label>
                                                            <input type="text" class=" form-control "
                                                                name="supplier" id="supplierAddress" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- đoạn script lấy dữ liệu nhà cung cấp --}}
                                                <script>
                                                    $(document).ready(function() {
                                                        // Đặt sự kiện change cho select box
                                                        $('.supplierSelect').on('change', function() {
                                                            var supplierId = $(this).val();
                                                            // Kiểm tra điều kiện để hiển thị bảng và dữ liệu


                                                            // Gửi yêu cầu Ajax để lấy dữ liệu sản phẩm từ máy chủ
                                                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                            $.ajax({
                                                                url: '/admin/nhacungcap', // Đường dẫn tới phương thức xử lý yêu cầu Ajax để lấy thông tin sản phẩm
                                                                method: 'POST',
                                                                data: {
                                                                    supplierId: supplierId,
                                                                    _token: csrfToken
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                    $('#supplierName').val(response
                                                                        .name);
                                                                    $('#supplierPhone').val(response
                                                                        .phone); // Hiển thị dữ liệu trong input
                                                                    $('#supplierAddress').val(response
                                                                        .address);
                                                                },
                                                                error: function(xhr) {
                                                                    // Xử lý khi có lỗi xảy ra
                                                                }
                                                            });

                                                            return false; // Ngăn trình duyệt tải lại trang
                                                        });
                                                    });
                                                </script>
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <span class="d-flex fw-bold ">
                                                                        <i class="ti ti-list-details h2 me-1"
                                                                            style="color:#1e8bff;"></i>
                                                                        <h2 style="color:#1e8bff;">StockinDetail</h2>
                                                                    </span>

                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input type="text" class="form-control"
                                                                        id="productSearch"
                                                                        placeholder="Search for a product"
                                                                        name="searchKeyword">
                                                                    <ul id="searchResults">
                                                                        <li id="noResultsItem" style="display: none;">
                                                                            No products found</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover"
                                                                    style="display: none;" id="datgold">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Items</th>
                                                                            <th>Unit</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price</th>
                                                                            <th>Into money</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tfoot id="cartFooter" style="display: none;">
                                                                        <tr class="text-right table-info">
                                                                            <td colspan="3"
                                                                                class="font-weight-bold">
                                                                                <strong>Total Quantity: </strong>
                                                                            </td>
                                                                            <td id="orderQuantity"></td>
                                                                            <td colspan="1"
                                                                                class="font-weight-bold"> <strong>Cash
                                                                                    for goods:</strong>
                                                                            </td>
                                                                            <td id="orderTotal"
                                                                                class="text-info font-weight-bold">0
                                                                            </td>

                                                                        </tr>
                                                                        <tr class="">
                                                                            <td colspan="5"
                                                                                class="align-middle font-weight-bold float-right">
                                                                                <strong class="right-0">Transport fee:
                                                                                </strong>
                                                                            </td>
                                                                            <td><input type="text"
                                                                                    id="txtShippingFee"
                                                                                    name="ShippingFee"
                                                                                    class="form-control text-right px-2" />
                                                                            </td>
                                                                            <td rowspan="3"></td>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <td colspan="5"
                                                                                class="align-middle font-weight-bold">
                                                                                <strong>Money down:</strong>
                                                                            </td>
                                                                            <td><input type="text" id="txtDiscount"
                                                                                    name="Discount"
                                                                                    class="form-control text-right px-2" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <td colspan="5"
                                                                                class="align-middle font-weight-bold">
                                                                                <strong>Paid:</strong>
                                                                            </td>
                                                                            <td><input type="text" id="txtPaid"
                                                                                    name="Paid"
                                                                                    class="form-control text-right px-2" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text-right table-info">
                                                                            <td colspan="5"
                                                                                class="font-weight-bold"><strong>Total
                                                                                    Price:</strong>
                                                                            </td>
                                                                            <td class="text-danger font-weight-bold">
                                                                                <input id="grandTotal" disabled
                                                                                    class="form-control border border-0"
                                                                                    type="text" name="totalPrice"> 
                                                                            </td>

                                                                        </tr>
                                                                    </tfoot>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                                            <a href="{{route('stockins.index')}}" class="btn btn-primary" >Save</a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- Đoạn sử dụng jquery để lấy dữ liệu khi chọn vào sản phẩm --}}

                        <style>
                            .my-input {
                                width: 50px;
                                padding: 5px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                            }
                        </style>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#productSearch').on('input', function() {
                                    var keyword = $(this).val();

                                    $.ajax({
                                        url: '/admin/search-product',
                                        type: 'GET',
                                        data: {
                                            keyword: keyword
                                        },
                                        success: function(response) {
                                            var searchResults = $('#searchResults');
                                            var noResultsItem = $('#noResultsItem');

                                            searchResults.empty();

                                            if (response.length > 0) {
                                                $.each(response, function(index, product) {
                                                    var listItem = $('<li>' + product.NAME + '</li>');
                                                    listItem.on('click', function() {
                                                        addToCart(product);
                                                    });
                                                    searchResults.append(listItem);
                                                });
                                            } else {
                                                noResultsItem.show();
                                            }
                                        }
                                    });
                                });

                                function addToCart(product) {
                                    var tableBody = $('#datgold tbody');

                                    var existingRow = tableBody.find('tr#' + product.PRO_ID);
                                    if (existingRow.length > 0) {
                                        var quantityInput = existingRow.find('.quantity-input');
                                        var quantity = parseInt(quantityInput.val()) + 1;
                                        quantityInput.val(quantity);

                                        var totalPriceCell = existingRow.find('.total-price');
                                        var price = parseFloat(product.PRICE);
                                        var totalPrice = quantity * price;
                                        totalPriceCell.text(numberFormat(totalPrice, 2, '.', ','));

                                    } else {
                                        var newRow = $('<tr>').attr('id', product.PRO_ID);
                                        newRow.append('<td>' + product.PRO_ID + '</td>');
                                        newRow.append('<td>' + product.NAME + '</td>');
                                        newRow.append('<td>' + product.unit + '</td>');
                                        newRow.append(
                                            '<td><input type="number" name="quantity" disabled class="form-control quantity-input" value="1"></td>'
                                        );
                                        newRow.append('<td>' + parseFloat(product.PRICE) + '</td>');
                                        newRow.append('<td class="total-price">' + parseFloat(product.PRICE) + '</td>');
                                        tableBody.append(newRow);
                                    }

                                    updateOrderSummary();

                                    $('#datgold').show();
                                    $('#cartFooter').show();
                                }

                                function updateOrderSummary() {
                                    var orderQuantity = 0;
                                    var orderTotal = 0;

                                    $('#datgold tbody tr').each(function() {
                                        var quantity = parseInt($(this).find('.quantity-input').val());
                                        var price = parseFloat($(this).find('td:nth-child(5)').text());
                                        orderQuantity += quantity;
                                        orderTotal += quantity * parseFloat(price);
                                    });

                                    $('#orderQuantity').text(orderQuantity);
                                    $('#orderTotal').text(orderTotal, 0, ',', '.');
                                    updateGrandTotal();
                                }

                                function updateGrandTotal() {
                                    var orderTotal = parseFloat($('#orderTotal').text());
                                    var shippingFee = parseFloat($('#txtShippingFee').val() || 0);
                                    var discount = parseFloat($('#txtDiscount').val() || 0);
                                    var paid = parseFloat($('#txtPaid').val() || 0);

                                    var grandTotal = orderTotal - shippingFee - discount - paid;

                                    $('#grandTotal').val(numberFormat(grandTotal, 0, ',', '.'));
                                }

                                function numberFormat(number, decimals, decPoint, thousandsSep) {
                                    decimals = typeof decimals !== 'undefined' ? decimals : 0;
                                    decPoint = typeof decPoint !== 'undefined' ? decPoint : '.';
                                    thousandsSep = typeof thousandsSep !== 'undefined' ? thousandsSep : ',';

                                    var parts = parseFloat(number).toFixed(decimals).split('.');
                                    var integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
                                    var decimalPart = parts.length > 1 ? decPoint + parts[1] : '';

                                    return integerPart + decimalPart;
                                }

                                // Sự kiện nhập giá trị vận chuyển, tiền giảm và đã thanh toán
                                $('#txtShippingFee, #txtDiscount, #txtPaid').on('input', function() {
                                    updateGrandTotal();
                                });
                            });
                        </script>


                        <style>
                            .modal-fullscreen {
                                width: 100%;
                                height: 100%;
                                margin: 0;
                                padding: 0;
                            }

                            .modal-dialog {
                                padding: 50px;

                            }

                            .modal-fullscreen .modal-content {
                                height: 100%;
                                border-radius: 10px;

                            }

                            .modal-fullscreen .modal-dialog {
                                height: 100%;
                                margin: 0;
                                max-width: 100%;
                            }
                        </style>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover " id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Date created</th>
                                    <th>Suppliers</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>total money</th>
                                    <th>Employee</th>
                                    <th></th>
                                    <th><input type="checkbox" class="select-all" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dem = 1; ?>
                                @foreach ($stockindetail as $data)
                                    <tr data-expanded="true">
                                        <td><?php echo $dem++; ?></td>
                                        <td>{{ date('d-m-Y', strtotime($data->stockin->CREATEDDATE)) }}
                                            <p>{{ date('H:i:s', strtotime($data->stockin->CREATEDDATE)) }}</p>
                                        </td>
                                        <td>{{ $data->stockin->supplier->NAME }}</td>
                                        <td>{{ $data->product->NAME }}</td>
                                        <td>{{ $data->QUANTITY }}</td>
                                        <td>{{ $data->product->unit }}</td>
                                        <td>{{ number_format($data->QUANTITY * $data->product->PRICE, 0, ',', '.') }}₫
                                        </td>
                                        <td>{{ $data->stockin->employee->LASTNAME }}
                                            {{ $data->stockin->employee->FIRSTNAME }}</td>
                                        {{-- <td>{{ number_format($data->PRICE, 0, ',', '.') }}₫</td>
                                        <td>{{ $data->unit }}</td>

                                        <td>
                                            @if ($data->category != null)
                                                {{ $data->category->NAME }}
                                            @else
                                                <p class="text-danger"> Chưa Có Danh Mục</p>
                                            @endif
                                        </td> --}}

                                        <td>
                                            <span class="d-flex">
                                                <button id="editStockinButton" style="color: #17a2b8"
                                                    data-stockin-id="{{ $data->IND_ID }}" type="button"
                                                    class=" editStockinButton h2 border border-0 float-end  bg-transparent"
                                                    data-bs-toggle="modal" data-bs-target="#editStockin">
                                                    <i class="ti ti-edit"></i></button>



                                                <a target="_blank"
                                                    href="{{ route('stockins.show', ['stockin' => $data->IND_ID]) }}"
                                                    class="h2 fw-bold" style="color: #28a745;"><i
                                                        class="ti ti-eye"></i></a>
                                            </span>

                                        </td>
                                        <td><input type="checkbox" class="select-row" /></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    {{-- script xử khi nhấn vào nhút chỉnh sửa gọi ajax để lấy dữ liệu trả về chỉnh sử nhé --}}
                    <script>
                        $(document).ready(function() {
                            $('.editStockinButton').click(function() {
                                var stockinID = $(this).data(
                                    'stockin-id'); // Lấy ID từ biến PHP và gán cho biến JavaScript

                                //đoạn này dùng để lấy giá trị của id của button được chọn nhằm mục đích lấy được id của stockindetail để update
                                var actionURL = "{{ route('stockins.update', ['stockin' => ':stockinID']) }}";
                                actionURL = actionURL.replace(':stockinID', stockinID);
                                $('#stockinForm').attr('action', actionURL);

                                // $('#stockinForm').submit();
                                $.ajax({
                                    url: '/admin/Editstockins/' +
                                        stockinID, // Đường dẫn tới phương thức xử lý yêu cầu Ajax để lấy thông tin sản phẩm
                                    type: 'GET',

                                    success: function(response) {
                                        // Xử lý dữ liệu trả về từ controller
                                        console.log(response);

                                        $('#supplierName1').val(response.supplierName);
                                        $('#title').text(response.supplierName);
                                        $('#supplierPhone1').val(response
                                            .supplierPhone); // Hiển thị dữ liệu trong input
                                        $('#supplierAddress1').val(response
                                            .supplierAddress);
                                    },
                                    error: function(xhr, status, error) {
                                        // Xử lý lỗi (nếu có)
                                        console.log(error);
                                    }

                                });
                            });
                        });
                    </script>

                    <!-- Modal  chỉnh sửa -->

                    <div class="modal fade" id="editStockin" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <form id="stockinForm"
                                action="{{ route('stockins.update', ['stockin' => $data->IND_ID]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" id="stockinID" name="stockinID" value="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <i class="ti ti-info-circle h1"></i>
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">EDIT STOCKIN - <span
                                                id="title" style="color: #1e8bff;font-weight: bold; "></span></h1>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <select class="form-select supplierSelect"
                                                            aria-label="Default select example" name="supplier1">
                                                            <option selected>---Please choose a supplier---
                                                            </option>
                                                            @foreach ($supplier1 as $supplier1)
                                                                <option value="{{ $supplier1->SUPP_ID }}">
                                                                    {{ $supplier1->NAME }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <select class="form-select "
                                                            aria-label="Default select example" name="warehouse1">
                                                            <option selected>---Please choose a Warehouse---
                                                            </option>
                                                            @foreach ($warehouse1 as $warehouse1)
                                                                <option value="{{ $warehouse1->WAR_ID }}">
                                                                    {{ $warehouse1->NAME }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label for="">Supplier Name </label>
                                                                <input type="text" class=" form-control "
                                                                    name="supplier" id="supplierName1" disabled>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="">PhoneNumber </label>
                                                                <input type="text" class=" form-control "
                                                                    name="supplier" id="supplierPhone1" disabled>
                                                            </div>
                                                        </div>
                                                        <label for="">Address </label>
                                                        <input type="text" class=" form-control " name="supplier"
                                                            id="supplierAddress1" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- đoạn script lấy dữ liệu nhà cung cấp --}}
                                            <script>
                                                $(document).ready(function() {
                                                    // Đặt sự kiện change cho select box
                                                    $('.supplierSelect').on('change', function() {
                                                        var supplierId = $(this).val();
                                                        // Kiểm tra điều kiện để hiển thị bảng và dữ liệu


                                                        // Gửi yêu cầu Ajax để lấy dữ liệu sản phẩm từ máy chủ
                                                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                        $.ajax({
                                                            url: '/admin/nhacungcap', // Đường dẫn tới phương thức xử lý yêu cầu Ajax để lấy thông tin sản phẩm
                                                            method: 'POST',
                                                            data: {
                                                                supplierId: supplierId,
                                                                _token: csrfToken
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                                $('#supplierName1').val(response
                                                                    .name);
                                                                $('#supplierPhone1').val(response
                                                                    .phone); // Hiển thị dữ liệu trong input
                                                                $('#supplierAddress1').val(response
                                                                    .address);
                                                            },
                                                            error: function(xhr) {
                                                                // Xử lý khi có lỗi xảy ra
                                                            }
                                                        });

                                                        return false; // Ngăn trình duyệt tải lại trang
                                                    });
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <span class="d-flex fw-bold ">
                                                                    <i class="ti ti-list-details h2 me-1"
                                                                        style="color:#1e8bff;"></i>
                                                                    <h2 style="color:#1e8bff;">StockinDetail</h2>
                                                                </span>

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <select class="form-select productSelect"
                                                                    id="productSelect" name="product1"
                                                                    aria-label="Default select example">
                                                                    <option selected>---Please choose a product---
                                                                    </option>
                                                                    @foreach ($product1 as $product1)
                                                                        <option value="{{ $product1->PRO_ID }}">
                                                                            {{ $product1->NAME }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover"
                                                                style="display: none;" id="datgold1">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Items</th>
                                                                        <th>Unit</th>
                                                                        <th>Quantity</th>
                                                                        <th>Into money</th>
                                                                        <th>TotalPrice</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Đoạn sử dụng jquery để lấy dữ liệu khi chọn vào sản phẩm --}}

                    <style>
                        .my-input {
                            width: 50px;
                            padding: 5px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                        }
                    </style>


                    <script>
                        $(document).ready(function() {
                            // Đặt sự kiện change cho select box
                            $('.productSelect').on('change', function() {
                                var productId = $(this).val();
                                // Kiểm tra điều kiện để hiển thị bảng và dữ liệu
                                $('#datgold1').css('display', 'block');

                                // Gửi yêu cầu Ajax để lấy dữ liệu sản phẩm từ máy chủ
                                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                $.ajax({
                                    url: '/admin/get-product-info', // Đường dẫn tới phương thức xử lý yêu cầu Ajax để lấy thông tin sản phẩm
                                    method: 'POST',
                                    data: {
                                        productId: productId,
                                        _token: csrfToken
                                    },
                                    success: function(response) {
                                        // Xóa nội dung cũ trong tbody của bảng
                                        $('#datgold1 tbody').empty();

                                        // Tạo HTML cho các dòng của bảng dựa trên dữ liệu sản phẩm
                                        $.each(response, function(index, product) {
                                            // Tạo một chuỗi ID duy nhất cho mỗi dòng sản phẩm
                                            var rowId = 'row_' + product.name;

                                            // Kiểm tra xem dữ liệu đã tồn tại trong bảng chưa
                                            if (!$('#datgold1 tbody').find('#' + rowId).length) {
                                                var row = '<tr id="' + rowId + '">' +
                                                    '<td>' + (index + 1) + '</td>' +
                                                    '<td>' + response.name + '</td>' +
                                                    '<td>' + response.unit + '</td>' +
                                                    '<td><input type="text" name="quantity1" class="form-control my-input text-center" value="' +
                                                    (product.quantity ? product.quantity : '1') +
                                                    '" onchange="calculateTotal(this, ' + parseFloat(
                                                        response.price) + ')" ></td>' +
                                                    '<td>' + parseFloat(response.price)
                                                    .toLocaleString() + '</td>' +
                                                    '<td > <input type="text" disabled  id="totalPrice1" class="form-control" value="' +
                                                    (parseFloat(response
                                                        .price) * (product.quantity ? product
                                                        .quantity :
                                                        1)).toLocaleString() + '"></td>' +
                                                    '</tr>';


                                                // Chèn dòng vào tbody của bảng
                                                $('#datgold1 tbody').append(row);
                                            }
                                        });

                                    },

                                    error: function() {
                                        // Xử lý lỗi khi gửi yêu cầu Ajax
                                    }
                                });
                            });
                        });

                        function calculateTotal(input, price) {
                            var quantity = parseFloat(input.value);
                            var totalPrice = quantity * price;
                            // document.getElementById("totalPrice").innerText =
                            //     totalPrice.toLocaleString();
                            $('#totalPrice1').val(totalPrice.toLocaleString());
                        }
                    </script>

                    <style>
                        .modal-fullscreen {
                            width: 100%;
                            height: 100%;
                            margin: 0;
                            padding: 0;
                        }

                        .modal-dialog {
                            padding: 50px;

                        }

                        .modal-fullscreen .modal-content {
                            height: 100%;
                            border-radius: 10px;

                        }

                        .modal-fullscreen .modal-dialog {
                            height: 100%;
                            margin: 0;
                            max-width: 100%;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>

</div>

@endSection
