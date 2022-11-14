@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid">
    <h1 class="mt-4">Pemasukkan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Bulan</li>
    </ol>
    <div class="col-sm text-right">
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
        @if(Auth::user()->id_jabatan == '1')
        <a href="{{route('tambah_bulan')}}"class="btn btn-primary">Tambah Bulan</a>
        @endif
        <div class="row gy-2">
            @foreach ($query as $row)
            <div class="col-lg-3">
            <div class="card border-left-primary shadow h-100 py-2">
                {{-- <a href="{{ route('detail_uang_kas',$row->tahun)}}"> --}}
                    <div class="card-body">
                        <div class="col-auto">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h6>{{$row->tahun}}</h6>
                            <div class="col mr-2">
                                <strong><a target="_blank" href="{{route('detail_uang_kas',Crypt::encryptString($row->id_bulan_pembayaran))}}">{{Str::ucfirst($row->nama_bulan)}} <!-- php ucfirst() --> </a></strong>
                            <div class="col mr-2">Rp{{number_format($row->nominal_bulanan)}}/Perbulan</div>
                                </div>
                            </div>
                        </div> 
                            </a>
                        @if(Auth::user()->id_jabatan == '1')
                        <form action="uang_kas{{$row->id_bulan_pembayaran}}" method="POST">
                            @csrf
                            @method('DELETE')   
                            <button type="submit" onclick="return confirm('Tekan OK Untuk Menghapus')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        @endif
                    </div>
                </a>
                </div>
            </div>
            @endforeach
        </div>
<!--
    <div class="col-lg-3">
        <div class="card shadow">
        <div class="card-body">
            <h5><a href="">Januari</a></h5>
            <h5 class="text-muted">2021</h>
                </div>
            </div>
        </div> -->

    </div>
    <!-- <div style="height: 100vh"></div> -->
    <!--<div class="card mb-4">
    <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div>
</div>-->
</div>
@endsection