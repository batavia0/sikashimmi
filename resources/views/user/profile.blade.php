@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
@auth
<div class="container-fluid">
    <h1 class="mt-4">Profil</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profil</li>
    </ol>
<div class="row">
    <div class="col-md-6">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <form action="{{ route('profile.action') }}" method="post">
            @csrf
            @method("put")
            <div class="mb-3">
                <label>Nama</label>
                <input class="form-control" type="text" value="{{old('name',Auth::user()->name)}}" name="name" required />
            </div>
            <div class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input class="form-control" type="text" value="{{old('name',Auth::user()->username)}}" name="username" disabled />
            </div>
            <div class="text-danger">
                @error('username')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label>NIM</label>
                <input class="form-control" type="text" value="{{old('nim',Auth::user()->nim)}}" name="username" disabled/>
            </div>
        </div>
            <div class="text-danger">
                @error('nim')
                    {{ $message }}
                @enderror
            <!--<div class="mb-3">
                <label>E-mail</label>
                <input class="form-control" type="email" value="bramasto@gmail.com" name="email_user" />
            </div> 
            <div class="mb-3">
                <label>No Telepon</label>
                <input class="form-control" type="tel" value"" name="telepon_user" />
            </div> -->
            <div class="mb-3">
                <button class="btn btn-primary">Ubah</button>
                <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection