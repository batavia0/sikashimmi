@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
@auth
<div class="container-fluid">
    <h1 class="mt-4">Ganti Password</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Ganti Password</li>
    </ol>
<div class="row">
    <div class="col-md-6">
        <!-- Session Error -->
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif  
        <!-- END Session Error -->
        <form action="{{ route('password.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Password Lama <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="old_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" />
            </div>
            <div class="text-danger">
                @error('old_password')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label>Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="new_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" />
            </div>
            <div class="text-danger">
                @error('new_password')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="new_password_confirmation" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"/>
            </div>
            <div class="text-danger">
                @error('new_password_confirmation')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Ubah</button>
                <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection

