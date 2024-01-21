@extends('penjual.warunglayouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/laporan">Laporan Penjualan</a></li>
                <li class="breadcrumb-item active">Data Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Laporan Penjualan</h5>
                        <form action="{{ route('laporan.getData') }}" method="get">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>
                                            <label for="start_date" class="form-label">Tanggal Awal</label>
                                        </th>
                                        <td>
                                            <input type="date" name="start_date" required class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="end_date">Tanggal Akhir</label>
                                        </th>
                                        <td>
                                            <input type="date" name="end_date" required class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Buat Laporan Penjualan</th>
                                        <td>
                                            <button type="submit" class="btn btn-md btn-primary">Buat
                                                Laporan</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bodyLaporan">

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $('form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('laporan.getData') }}',
                type: 'GET',
                data: $('form').serialize(),
                success: function(response) {
                    // Hapus data lama dari tabel
                    $('table tbody.bodyLaporan').empty();

                    // Iterasi melalui data dan tambahkan ke tabel
                    if (response.length > 0) {
                        $.each(response, function(index, transaction) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + transaction.id + '</td>' +
                                '<td>' + transaction.code + '</td>' +
                                '<td>' + transaction.formatted_created_at + '</td>' +
                                '<td>' + 'Rp' + transaction.total_price + '</td>' +
                                '</tr>';

                            $('table tbody.bodyLaporan').append(row);

                        });
                    } else {
                        // Tampilkan pesan jika tidak ada data
                        var emptyRow =
                            '<tr><td colspan="5" class="text-center">Tidak ada data penjualan dalam rentang tanggal yang diminta</td></tr>';
                        $('table tbody.bodyLaporan').append(emptyRow);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';

                    // Jika terdapat pesan kesalahan dalam respons server, gunakan pesan tersebut
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }

                    alert(errorMessage);
                }
            });
        });
    </script>
@endpush