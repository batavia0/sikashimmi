@extends('app')
@section('content')
<div class="row">
    <div class="col-md-6">
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <h3 class="text-primary">Selamat Datang Di Sistem Informasi Pengelolaan Uang Kas HIMMI</h3>
        <form action="{{ route('register.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required/>
                <div class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label>NIM Mahasiswa<span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="nim" placeholder="NIM mahasiswa" value="{{ old('nim') }}" required />
            </div>
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="username" name="username" placeholder="Username" value="{{ old('username') }}" required />
            </div>
            <div class="mb-3">
                <input class="form-control" type="hidden" name="id_jabatan" value="2"/>
            </div>
            <div class="mb-3">
                <label>No Telepon Seluler <span class="text-danger">*</span></label>
                <input class="form-control" type="tel" name="no_telepon" placeholder="08123456789" value="{{ old('no_telepon') }}" required />
            </div>
            <div class="mb-3">  
                <label>Email <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}"/>
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" placeholder="Password" required />
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password_confirm" placeholder="Konfirmasi Password" required />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Register</button>
                <a class="btn btn-danger" href="{{ route('login') }}">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection