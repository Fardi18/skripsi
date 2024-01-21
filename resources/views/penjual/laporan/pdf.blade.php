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
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                @foreach ($warungs as $warung)
                    <h3 class="text-center">Data Laporan Penjualan {{ $warung->name }}</h3>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">
                @php
                    $total_price = 0; // Definisikan variabel total_price di sini
                @endphp
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporanPenjualan as $index => $transaction)
                            @php
                                $total_price += $transaction->total_price;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaction->code }}</td>
                                <td>{{ $transaction->formatted_created_at }}</td>
                                <td>Rp{{ number_format($transaction->total_price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Total : <span><b>Rp{{ number_format($total_price) }}</b></span></h3>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
