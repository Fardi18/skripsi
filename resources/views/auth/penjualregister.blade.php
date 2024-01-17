<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>Warko | Penjual Register</title>

    <style>
        .register-box {
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
            width: 500px;
            background-color: white;
            border-radius: 32px
        }
    </style>
</head>

<body>
    <div class=" d-flex justify-content-center align-items-center my-5">
        <div class="register-box p-5 ">
            <div class="title mb-3">
                <h3 class="text-center">Selamat Datang <span class="text-primary">Penjual</span></h3>
                <p class="text-secondary text-center">Masukin data kamu dan dapatkan orderan pertama</p>
            </div>
            <form method="POST" action="{{ route('do.penjualregister') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" aria-describedby="nameHelp">
                    @error('name')
                        <div id="nameHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" aria-describedby="emailHelp">
                    @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        name="phone_number" id="phone_number" aria-describedby="phone_numberHelp">
                    @error('phone_number')
                        <div id="phone_numberHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="provinces" class="form-label">Provinsi</label>
                    <select class="form-select" aria-label="Default select example" name="provinces_id"
                        id="provinces_id">
                    </select>
                </div>
                <div class="mb-3">
                    <label for="provinces" class="form-label">Kabupaten Kota</label>
                    <select class="form-select" aria-label="Default select example" name="regencies_id"
                        id="regencies_id">
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                        aria-describedby="addressHelp"></textarea>
                    @error('address')
                        <div id="addressHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password">
                    @error('password')
                        <div id="passwordHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation">
                    @error('password_confirmation')
                        <div id="passwordConfirmationHelp" class="form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 mt-5 ">
                    <button class="btn btn-primary w-100" style="border-radius: 20px"
                        type="sub
                    ">Register</button>
                    <p class="mt-3 text-center">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"><b>silakan login.</b></a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#provinces_id").select2({
                placeholder: '-- Pilih Provinsi --',
                ajax: {
                    url: "{{ route('provinsi.index') }}",
                    processResults: function({
                        data
                    }) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            });

            $("#provinces_id").change(function() {
                let id = $('#provinces_id').val();

                $("#regencies_id").select2({
                    placeholder: '-- Pilih Kabupaten Kota --',
                    ajax: {
                        url: "{{ url('selectRegency') }}/" + id,
                        processResults: function({
                            data
                        }) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    }
                                })
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
