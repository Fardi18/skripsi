<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan Penjualan</title>

    <style>
        .styled-table {
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                @foreach ($warungs as $warung)
                    <h3 class="text-center mb-3">Data Laporan Penjualan {{ $warung->name }}</h3>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">
                @php
                    $total = 0; // Definisikan variabel total di sini
                @endphp
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($laporanPenjualan as $index => $transaction)
                            @php
                                $total += $transaction->total;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaction->formatted_created_at }}</td>
                                <td>Rp{{ number_format($transaction->total) }}</td>
                            </tr>
                        @endforeach --}}
                        @foreach ($laporanPenjualan as $index => $data)
                            @php
                                $total += $data['total'];
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['date'] }}</td>
                                <td>Rp{{ number_format($data['total']) }}</td>
                            </tr>
                        @endforeach

                        <tr class="active-row">
                            <td colspan="2">Total </td>
                            <td>Rp{{ number_format($total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
