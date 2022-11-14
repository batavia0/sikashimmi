@section ('title')
Pengeluaran
@endsection
@extends('layouts/app_wrap_layouts')
@section ('page')
Ubah Data Pengeluaran
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">

        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Ubah</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/pengeluaran/insert" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" value="{{ $pengeluaran->nama }}">
                    <div class="text-danger">
                        @error('nama')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-grup">
                    <label for="exampleInputEmail1">Tanggal Pengeluaran</label>
                    <input type="text" name="tanggal_pengeluaran" class="form-control" id="exampleInputEmail1" placeholder="Masukan Tanggal Pengeluaran" value="{{ $pengeluaran->tanggal_pengeluaran }}">
                    <div class="text-danger">
                        @error('tanggal_pengeluaran')
                            {{ $message }}
                        @enderror
                    </div>
                </div>  
                <div class="form-grup">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1" placeholder="Masukan Keterangan" value="{{ $pengeluaran->keterangan }}">
                    <div class="text-danger">
                        @error('keterangan')
                            {{ $message }}
                        @enderror
                    </div>
                </div> 
                <div class="form-grup">
                    <label for="exampleInputEmail1">Jumlah Pengeluaran</label>
                    <input type="text" name="jumlah_pengeluaran" class="form-control" id="exampleInputEmail1" placeholder="Masukan Jumlah Pengeluaranan" value="{{ $pengeluaran->jumlah_pengeluaran }}">
                    <div class="text-danger">
                        @error('jumlah_pengeluaran')
                            {{ $message }}
                        @enderror
                    </div>
                </div>  
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
</form>
</div>
<!-- /.card -->
</div>
</div>
</div>
@endsection