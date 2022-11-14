<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link rel="stylesheet" href={{asset('css/styles.css')}}>
        <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>                 
            img {
                width: 100%;
            }
            body{
                background-color: #fafafa;
            }
        </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="brand">
                                        <img src="{{asset('img/sikashimmi.png')}}" alt="gambarlogo">
                                    </div>  
                                    <div class="card-body">
                                        <form action="{{ route('login.action') }}" method="POST">
                                            @csrf
                                            <h3 class="text-center font-weight-light">Login</h3>
                                            <!-- Session Alert -->
                                            @if(session('success'))
                                            <p class="alert alert-success">{{ session('success') }}</p>
                                            @endif
                                            @if (session('error'))
                                            <p class="alert alert-danger">{{ session('error') }} </p>
                                            @endif
                                            <!-- END Session Alert -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="text"  name="username" placeholder="Username"/>
                                                <label for="username"><span>                                                <i class=" fa-regular fa-user text-secondary"></i>
                                                </span> Username</label>
                                            </div>
                                            <div class="text-danger">
                                                @error('username')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                                <label for="inputPassword"><i class="fa fa-key text-secondary"></i> Password</label>
                                            </div>
                                            <div class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div> -->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{ route('register') }}">Belum punya akun</a></div>
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
                            <div class="text-muted">Copyright &copy; Kelompok 02 @php echo date("Y"); @endphp
                            </div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{asset('chart/chart-area-demo.js')}}"></script>

<script src="{{asset('chart/chart-bar-demo.js')}}"></script>

<script src="{{asset('chart/chart-pie-demo.js')}}"></script>

<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    </body>
</html>
