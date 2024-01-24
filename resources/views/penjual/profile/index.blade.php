@extends('penjual.warunglayouts.app')

@section('title', 'Profile')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Penjual</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h2>{{ $profile->name }}</h2>
                        <h3>{{ $profile->warung->name }}</h3>
                    </div>
                </div>

            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Bengkel</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->warung->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->phone_number }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Provinsi</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->province->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kabupaten Kota</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->regency->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat Lengkap</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->address }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ url('/penjual/profile/' . $profile->id) }}">
                                    @method('put')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ $profile->name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email"
                                                value="{{ $profile->email }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Nomor Telepon</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone_number" type="text" class="form-control" id="phone_number"
                                                value="{{ $profile->phone_number }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="address" type="text" class="form-control" id="Address">{{ $profile->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
