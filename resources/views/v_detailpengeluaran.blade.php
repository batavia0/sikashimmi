@section('title')
Pengeluaran
@endsection
@extends('layouts/app_wrap_layouts')

@section('page')
Halaman Detail Pengeluaran
@endsection
@section('overview')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Quick Example</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama :</label>
                {{$pengeluaran->nama}}
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Pengeluaran :</label>
                {{$pengeluaran->tanggal_pengeluaran}}
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Keterangan :</label>
                {{$pengeluaran->keterangan}}
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Jumlah Pengeluaran :</label>
                {{$pengeluaran->jumlah_pengeluaran}}
            </div>

        </div>

        <div class="card-footer">
            <a href="/pengeluaran"><button type="button" class="btn btn-sm btn-primary">Kembali</button></a>
        </div>
    </form>
</div>
@endsection