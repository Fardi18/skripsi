@extends('penjual.warunglayouts.app')

@section('title', 'Rekening')

@section('content')
    <div class="pagetitle">
        <h1>Data Rekening</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/rekening">Rekening</a></li>
                <li class="breadcrumb-item active">Data Rekening</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Rekening</h5>
                        @if ($rekenings->isEmpty())
                            <a type="button" class="btn btn-primary m-2" href="/penjual/rekening/add"><i
                                    class="bi bi-plus-square-fill"></i> Tambah Rekening</a>
                        @else
                            <a type="button" class="btn btn-primary m-2 disabled " href="/penjual/rekening/add"><i
                                    class="bi bi-plus-square-fill"></i> Tambah Rekening</a>
                        @endif
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Bank</th>
                                    <th scope="col">Pemilik Rekening</th>
                                    <th scope="col">Nomor Rekening</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekenings as $rekening)
                                    <tr>
                                        <td>{{ $rekening->bank_name }}</td>
                                        <td>{{ $rekening->name }}</td>
                                        <td>{{ $rekening->bank_number }}</td>
                                        <td><a href="/penjual/rekening/{{ $rekening->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil-fill text-white"></i></a>
                                            | <a href="/penjual/rekening/{{ $rekening->id }}" class="btn btn-primary"><i
                                                    class="bi bi-eye-fill text-white"></i></a>
                                            | <a href="/penjual/rekening/{{ $rekening->id }}/delete"
                                                class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
