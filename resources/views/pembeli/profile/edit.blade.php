@extends('pembeli.layouts.app')

@section('title', 'Profile')

@section('styles')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <style>
        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-img-top {
            display: block;
            width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            border-top: 1px solid rgba(0, 0, 0, 0.3) !important;
            background: #fff;
        }

        .card-inverse .btn {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .profile-inline {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline~.card-title {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold {
            font-weight: 700;
        }

        .meta {
            font-size: 1em;
            color: rgba(0, 0, 0, .4);
        }

        .meta a {
            text-decoration: none;
            color: rgba(0, 0, 0, .4);
        }

        .meta a:hover {
            color: rgba(0, 0, 0, .87);
        }

        /* Tabs Card */
        .tab-card {
            border: 1px solid #eee;
        }

        .tab-card-header {
            background: none;
        }

        /* Default mode */
        .tab-card-header>.nav-tabs {
            border: none;
            margin: 0px;
        }

        .tab-card-header>.nav-tabs>li {
            margin-right: 2px;
        }

        .tab-card-header>.nav-tabs>li>a {
            border: 0;
            border-bottom: 2px solid transparent;
            margin-right: 0;
            color: #737373;
            padding: 2px 15px;
        }

        .tab-card-header>.nav-tabs>li>a.show {
            border-bottom: 2px solid #007bff;
            color: #007bff;
        }

        .tab-card-header>.nav-tabs>li>a:hover {
            color: #007bff;
        }

        .tab-card-header>.tab-content {
            padding-bottom: 0;
        }
    </style>

@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col mt-4">
                <div class="card">
                    <div class="card-block">
                        <h3 class="mb-3">Edit Profile</h3>
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

                        <form method="POST" action="{{ url('/profile/' . $user->id) }}">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" aria-describedby="nameHelp" value="{{ $user->name }}">
                                @error('name')
                                    <div id="nameHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" aria-describedby="emailHelp" value="{{ $user->email }}">
                                @error('email')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number" id="phone_number" aria-describedby="phone_numberHelp"
                                    value="{{ $user->phone_number }}">
                                @error('phone_number')
                                    <div id="phone_numberHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                    aria-describedby="addressHelp">{{ $user->address }}</textarea>
                                @error('address')
                                    <div id="addressHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 mt-5 ">
                                <button class="btn btn-primary w-100" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
