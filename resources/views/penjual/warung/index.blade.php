@extends('penjual.warunglayouts.app')

@section('title', 'Warung')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/warung">Warung</a></li>
                <li class="breadcrumb-item active">Data Warung</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Warung</h5>
                        @if ($warungs->isEmpty())
                            <a type="button" class="btn btn-primary m-2" href="/penjual/warung/add"><i
                                    class="bi bi-plus-square-fill"></i> Tambah Warung</a>
                        @else
                            <a type="button" class="btn btn-primary m-2 disabled " href="/penjual/warung/add"><i
                                    class="bi bi-plus-square-fill"></i> Tambah Warung</a>
                        @endif
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warungs as $warung)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td>{{ $warung->name }}</td>
                                        <td><img src="{{ Storage::url($warung->image) }}" alt=""
                                                style="height:40px; width:60px; object-fit: cover;">
                                        </td>
                                        <td>{{ $warung->address }}</td>
                                        <td><a href="/penjual/warung/{{ $warung->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil-fill text-white"></i></a>
                                            | <a href="/penjual/warung/{{ $warung->id }}" class="btn btn-primary"><i
                                                    class="bi bi-eye-fill text-white"></i></a>
                                            | <a href="/penjual/warung/{{ $warung->id }}/delete" class="btn btn-danger"><i
                                                    class="bi bi-trash3-fill text-white"></i></a>
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
