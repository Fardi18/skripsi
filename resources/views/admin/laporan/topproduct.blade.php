@extends('admin.layouts.app')

@section('title', 'Top Products Admin')

@section('content')
    <div class="pagetitle">
        <h1>Data Top Produk Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/laporan/topproduct">Top Produk</a></li>
                <li class="breadcrumb-item active">Data Top Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Produk dengan Periode</h5>
                        <form action="{{ route('laporan.getTopProductsAdmin') }}" method="get">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>
                                            <label for="warung_id" class="form-label">Pilih Warung</label>
                                        </th>
                                        <td>
                                            <select class="form-select" aria-label="Default select example"
                                                name="warung_id">
                                                <option selected>-- Pilih Warung --</option>
                                                @foreach ($warungs as $warung)
                                                    <option value="{{ $warung->id }}">{{ $warung->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
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
                                        <th></th>
                                        <td>
                                            <button type="submit" class="btn btn-md btn-primary">Buat
                                                Top Produk</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody class="bodyLaporanAdmin">

                            </tbody>
                        </table>
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

            // Periksa apakah warung_id sudah dipilih
            var selectedWarung = $('select[name="warung_id"]').val();
            if (!selectedWarung || selectedWarung === '-- Pilih Warung --') {
                alert('Harap pilih warung terlebih dahulu.');
                return; // Berhenti jika warung_id belum dipilih
            }

            $.ajax({
                url: '{{ route('laporan.getTopProductsAdmin') }}',
                type: 'GET',
                data: $('form').serialize(),
                success: function(response) {
                    // Hapus data lama dari tabel
                    $('table tbody.bodyLaporanAdmin').empty();

                    // Iterasi melalui data dan tambahkan ke tabel
                    if (response.length > 0) {
                        $.each(response, function(index, data) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + data.product_name + '</td>' +
                                '<td>' + data.total_quantity_sold + '</td>' +
                                '</tr>';

                            $('table tbody.bodyLaporanAdmin').append(row);
                        });
                    } else {
                        // Tampilkan pesan jika tidak ada data
                        var emptyRow =
                            '<tr><td colspan="3" class="text-center">Tidak ada data top product dalam rentang tanggal yang diminta</td></tr>';
                        $('table tbody.bodyLaporanAdmin').append(emptyRow);
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
