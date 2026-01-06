<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    let table = $('#table-category').DataTable({
        searching: false,
        ordering: true,
        order: [[0, 'asc']]
    });

    // load pertama
    getCategoryData();

    $('.btn-get-data').on('click', function () {
        getCategoryData();
    });

    function getCategoryData() {

        let filter_kode = $('#filter-kode').val();
        let filter_nama = $('#filter-nama').val();

        table.clear().draw();

        $.ajax({
            url: '{{ url("categories/search") }}',
            type: 'GET',
            dataType: 'json',
            data: {
                kode: filter_kode,
                nama: filter_nama
            },
            success: function (res) {

                let data = res.data;

                $.each(data, function (index, item) {

                    // ===== FORMAT ITEM =====
                    let jumlah_item = item.items.length;

                    let daftar_item = '-';
                    if (jumlah_item > 0) {
                        daftar_item = item.items
                            .map(i => i.nama)
                            .join(', ');
                    }

                    let btnView = `
                        <a href="{{ url('categories/view') }}/${item.id}"
                           class="btn btn-sm btn-primary">
                           View
                        </a>
                    `;

                    table.row.add([
                        item.kode,
                        item.nama,
                        jumlah_item,
                        daftar_item,
                        btnView
                    ]).draw(false);
                });
            },
            error: function () {
                alert('Gagal mengambil data kategori');
            }
        });
    }

});
</script>
