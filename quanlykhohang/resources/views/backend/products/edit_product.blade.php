@extends('backend.layouts.master')
@section('main-content')
@section('title', 'ADD-PRODUCTS')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-semibold mb-4 text-center text-dark">EDIT PRODUCT</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('products.update', ['product' => $product->PRO_ID]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="tensp"
                                        aria-describedby="emailHelp" placeholder="Nhập Tên Sản Phẩm" name="name"
                                        value="{{ $product->NAME }}">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <label for="price" class="form-label">price/one Product <span
                                                class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            placeholder="Nhập Giá Tiền"
                                            value="{{ number_format($product->PRICE, 0, ',', '.') }}">

                                        {{-- đoạn script để format tiền việt nam --}}
                                        <script>
                                            function number_format(number, decimals, decPoint, thousandsSep) {
                                                number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
                                                var n = !isFinite(+number) ? 0 : +number
                                                var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
                                                var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
                                                var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
                                                var s = ''

                                                var toFixedFix = function(n, prec) {
                                                    var k = Math.pow(10, prec)
                                                    return '' + (Math.round(n * k) / k)
                                                        .toFixed(prec)
                                                }

                                                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
                                                if (s[0].length > 3) {
                                                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
                                                }
                                                if ((s[1] || '').length < prec) {
                                                    s[1] = s[1] || ''
                                                    s[1] += new Array(prec - s[1].length + 1).join('0')
                                                }

                                                return s.join(dec)
                                            }

                                            function formatVND(price) {
                                                return number_format(price, 0, '.', ',');
                                            }

                                            document.getElementById("price").addEventListener("keyup", function() {
                                                this.value = formatVND(this.value);
                                            });
                                        </script>
                                        {{-- Kết thúc script để format tiền việt nam --}}
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="category" class="form-label"> Categorys <span
                                                class="text-danger">(*)</span></label>
                                        <select class="form-select" aria-label="Default select example" name="category">
                                            <option selected>Danh Mục Chứa Sản Phẩm</option>
                                            @foreach ($category as $category)
                                                <option value="{{ $category->CATE_ID }}">{{ $category->NAME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="unit" class="form-label">Unit <span
                                                class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control" name="unit" id="unit"
                                            placeholder="Nhập Đơn Vị Tính" value="{{ $product->unit }}">
                                    </div>
                                </div>




                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary">UPDATE</button>
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
