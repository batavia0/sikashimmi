@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid">
    <h1 class="mt-4">Tambah Bulan Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('uang_kas') }}">Overview</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    <form action="{{route('action_bulan_pembayaran')}}" method="POST">
      @csrf
      <div class="form-group col-md-6">
        @if(session('success'))
        <p class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">{{session('success')}} &times;</a></p>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dissmissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>a</strong>{{ session('error') }}</div>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
      <div class="row">
        <div class="col">
          <label for="nama_bulan">Nama Bulan</label>
          <select name="nama_bulan" class="form-control">
            <option disabled selected>--- Pilih ---</option>
            @foreach ($dropdown as $row)
            <option value="{{$row}}">{{Str::ucfirst($row)}}</option> <!-- php ucfirst() -->
            @endforeach
          </select>
        </div>
        <div class="col">
          <label for="tahun">Tahun</label>
          <input type="number" class="form-control" id="tahun" placeholder="Tahun" value="2020" name="tahun" required>
        </div>
      </div>
    </div>
      <div class="form-row" id="validationserver03">
        <div class="col-md-2">
          <label for="nominal">Nominal Pembayaran</label>
          <input type="number" class="form-control" id="nominal" name="nominal_bulanan" placeholder="Rp." required/><span class="text-danger"><small>Minimal Rp.1000</small></span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- <div style="height: 100vh"></div>
    <div class="card mb-4">
    <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div>
    -->
@endsection