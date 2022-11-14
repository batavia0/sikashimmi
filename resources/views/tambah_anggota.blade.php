@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid">
    <h1 class="mt-4">Tambah Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('anggota') }}">Overview</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    <form action="{{route('tambah.anggota')}}" method="POST">
    @csrf
    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama">
                    <div class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" name="nim" class="form-control" placeholder="NIM Mahasiswa">
                    <div class="text-danger">
                        @error('nim')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No Telepon</label>
                    <input type="tel" name="no_telepon" class="form-control" placeholder="08123456789">
                    <div class="text-danger">
                        @error('no_telepon')
                        {{ $message }}
                        @enderror
                    </div>
                </div> 
            </div>
        </div>  
    </div>
</div>
            <!-- /.card-body -->            
            <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<!-- /.card -->
@endsection