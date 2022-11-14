@extends('app')
@section('content')
<div class="row">
    <div class="col-md-6">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if (session('error'))
        <p class="alert alert-danger">{{ session('error') }} </p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <h3 class="text-primary">Selamat Datang Di Sistem Informasi Pengelolaan Uang Kas HIMMI</h3>
        <form action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="username" name="username" value="{{ old('username') }}" />
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Login</button>
                {{-- <a class="btn btn-danger" href="{{ route('home') }}">Back</a> --}}
                
                <a class="btn btn-info" href="{{route ('register')}}">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
