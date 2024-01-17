@extends('admin.layouts.app')

@section('title', 'Penjual')

@section('content')
    <div class="pagetitle">
        <h1>Data Penjual</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/penjual">Penjual</a></li>
                <li class="breadcrumb-item active">Data Penjual</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Penjual</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col">Nama</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjuals as $penjual)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td>{{ $penjual->name }}</td>
                                        <td>{{ $penjual->phone_number }}</td>
                                        <td>
                                            {{-- <a href="/admin/penjual/{{ $penjual->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil-fill text-white"></i></a> --}}
                                            |
                                            <a href="/admin/penjual/{{ $penjual->id }}" class="btn btn-primary"><i
                                                    class="bi bi-eye-fill text-white"></i></a>
                                            |
                                            {{-- <a href="/admin/penjual/{{ $penjual->id }}/delete" class="btn btn-danger"><i
                                                    class="bi bi-trash3-fill text-white"></i></a> --}}
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
