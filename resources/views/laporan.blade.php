@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid ">
    <h1 class="mt-4">Laporan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href={{route('home')}}>Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan</li>
    </ol>
    <div class="col-lg-5 mb-4">
        <h3>Pemasukkan</h3> 
        <form target="_blank" method="GET" action="{{route('x.pemasukkan')}}"> 
            @csrf
            <div class="form-group" id="id_bulan_pembayaran">
                <label for="id_bulan_pembayaran">Pilih Bulan Pembayaran</label>
                <select name="id_bulan_pembayaran" id="id_bulan_pembayaran" class="form-control">
        @foreach ($query as $row)
                <option value="{{$row->id_bulan_pembayaran}}" selected>{{$row->tahun}} | {{ucwords($row->nama_bulan)}} | Rp{{number_format($row->nominal_bulanan)}}</option>
        @endforeach
                </select>
        </div>
        <div class="form-group">
            <button type="submit" name="btnLaporanPemasukkan" class="btn btn-primary">Laporan Pemasukkan</button>
        </div>
    </form>
</div>
</div>
<div class="container-fluid">
<div class="col-lg-5 ml-4">
    <h3>Pengeluaran</h3>
    <form method="GET" action="/laporan/print_pengeluaran"> 
        @csrf
        <div class="row">
            <div class="col-lg">
                <div class="form-group">
                    <label for="dari_tanggal">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" id="dari_tanggal" value="<?= date('Y-m-01'); ?>">
                </div>
            </div>
            <div class="col-lg">
                <div class="form-group">
                    <label for="sampai_tanggal">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" id="sampai_tanggal" value="<?= date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="btnLaporanPengeluaran" class="btn btn-primary">Laporan Pengeluaran</button>
        </div>
    </form>

    <script>
		$(document).ready(function() {
			function print() {
				window.print();
			}
		});
	</script>
</div>
</div>
@endsection