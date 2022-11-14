@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid px-4">
    <h1 class="mt-4">Riwayat Pemasukkan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href={{route('home')}}>Dashboard</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <!--<div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>-->
    <div class="card mb-4">
        <!-- <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div> -->
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bulan | Tahun | Nominal Bulanan</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach ($query as $row)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{ucwords($row->nama_bulan).' | '.$row->tahun.' | Rp'.number_format($row->nominal_bulanan)}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->nim}}</td>
                        <td>{{$row->aksi}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($row->tanggal))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection