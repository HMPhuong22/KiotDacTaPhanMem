<script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('backend/assets/js/datatables.js') }}"></script>

<style>
    .selected-row {
        background-color: #abdde5 !important;
        /* Màu nền của dòng được chọn */
    }

    /* .selected-row:hover {
        background-color: #bef1ff !important; */
    /* Màu nền của dòng khi rê chuột vào */
</style>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
{{-- phần hiển thị check box chọn --}}
{{-- <script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        });

        $('#myTable tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        $('#selectAll').on('click', function() {
            if ($(this).is(':checked')) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
        });
    });
    $(document).ready(function() {
        // Xử lý sự kiện khi click vào checkbox "Chọn tất cả"
        $('.select-all').on('click', function() {
            var isChecked = $(this).prop('checked');

            // Đặt trạng thái của tất cả các checkbox trong tbody theo giá trị của checkbox "Chọn tất cả"
            $('#myTable tbody .select-row').prop('checked', isChecked);
        });
    });
</script> --}}


{{-- Đoạn này không cần màu --}}
{{-- <script>
    $(document).ready(function() {
        // Xử lý sự kiện khi click vào checkbox "Chọn tất cả"
        $('.select-all').on('click', function() {
            var isChecked = $(this).prop('checked');

            // Đặt trạng thái của tất cả các checkbox trong tbody theo giá trị của checkbox "Chọn tất cả"
            $('#myTable tbody .select-row').prop('checked', isChecked);
        });
    });
</script> --}}

{{-- Đoạn này có màu có checkbox --}}
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
