@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid">
    <h1 class="mt-4">Tambah Pengeluaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pengeluaran') }}">Overview</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    
    <form action="{{route('action.pengeluaran')}}" method="POST">
            @csrf
                <div class="mb-3">
                <div class="form-group">
                    <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                    <input type="number" name="jumlah_pengeluaran" class="form-control" placeholder="Cth: 5000">
                    <div class="text-danger">
                        @error('jumlah_pengeluaran')
                            {{ $message }}
                        @enderror
                    </div>
                </div>  
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Cth: Biaya promosi">
                    <div class="text-danger">
                        @error('keterangan')
                            {{ $message }}
                        @enderror
                    </div>
                </div>   
            </div>

            <!-- /.card-body -->
                <button type="submit" class="btn btn-primary">Save</button>
            
</form>
</div>
<!-- /.card -->
</div>
</div>
</div>
@endsection