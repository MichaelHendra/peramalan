<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('sbadmin/assets/css/style.css') }}">
    <title>Item Roti</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            margin: 2cm;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #00FFFF;
            color: black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Data Item Roti</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produksi as $item)
                <tr>
                    <td>{{ $item->kode_produk }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->harga_jual }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
