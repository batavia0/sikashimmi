<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
    <script lsrc="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #fafafa
        }
    </style>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register.action') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="name" id="name"
                                                        type="text" placeholder="Nama" value="{{ old('name') }}" />
                                                    <label for="name"><span
                                                            class="bg-white px-4 border-md border-right-0">
                                                            <i class="fa fa-user text-muted"></i>
                                                        </span>Nama <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="nim" id="nim"
                                                        type="text" placeholder="NIM Mahasiswa"
                                                        value="{{ old('nim') }}" />
                                                    <label for="nim"><span
                                                            class="bg-white px-4 border-md border-right-0">
                                                            <i class="fa fa-user text-muted"></i>
                                                        </span>NIM <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="text-danger">
                                                    @error('nim')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text"
                                                placeholder="Username" value="{{ old('username') }}" />
                                            <label for="username"><span class="bg-white px-4 border-md border-right-0">
                                                    <i class="fa fa-user text-muted"></i>
                                                </span>Username <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <!-- Hidden -->
                                        <div class="mb-3">
                                            <input class="form-control" type="hidden" name="id_jabatan"
                                                value="2" />
                                        </div>

                                        <!-- Email -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email"
                                                placeholder="name@example.com" value="{{ old('email') }}" />
                                            <label for="email"><span class="bg-white px-4 border-md border-right-0">
                                                    <i class="fa fa-envelope-square text-muted"></i>
                                                </span>Email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="no_telepon" id="no_telepon" type="tel"
                                                placeholder="No Telepon" value="{{ old('no_telepon') }}" />
                                            <label for="no_telepon"><span
                                                    class="bg-white px-4 border-md border-right-0">
                                                    <i class="fa fa-phone-square text-muted"></i>
                                                </span>No Telepon Seluler <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="text-danger">
                                            @error('no_telepon')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <!-- password -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password" id="password"
                                                        type="password" placeholder="Create a password" />
                                                    <label for="password"><span
                                                            class="bg-white px-4 border-md border-right-0">
                                                            <i class="fa fa-lock text-muted"></i>
                                                        </span>Password <span class="text-danger">*</label>
                                                </div>
                                                <div class="text-danger">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- password_confirm -->
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password_confirm"
                                                        id="password_confirm" type="password"
                                                        placeholder="Confirm password" />
                                                    <label for="password_confirm"><span
                                                            class="bg-white px-4 border-md border-right-0">
                                                            <i class="fa fa-lock text-muted"></i>
                                                        </span>Konfirmasi Password <span class="text-danger">*</label>
                                                </div>
                                                <div class="text-danger">
                                                    @error('password_confirm')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit"
                                                    class="btn btn-primary btn-block">Register</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('login') }}">Login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Kelompok 02 @php echo date("Y"); @endphp</div>
                        <!--<div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>-->
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>
