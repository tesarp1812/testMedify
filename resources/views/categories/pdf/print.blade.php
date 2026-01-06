<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }
        h2 {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
        }
        th {
            background: #f2f2f2;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <h2>Data Master Kategori</h2>

    <p>
        <strong>Nama Kategori:</strong> {{ $category->nama }} <br>
        <strong>Kode Kategori:</strong> {{ $category->kode }}
    </p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Item</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Laba</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @forelse($category->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>{{ number_format($item->harga_beli) }}</td>
                    <td>{{ number_format($item->laba) }}</td>
                    <td>{{ number_format($item->harga_beli + $item->laba) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">
                        Tidak ada item pada kategori ini
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>
        Dicetak pada: {{ $printed_at->format('d-m-Y H:i:s') }}
    </footer>

</body>
</html>
