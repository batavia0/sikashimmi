@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pengeluaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href={{route('home')}}>Dashboard</a></li>
        <li class="breadcrumb-item active">Pengeluaran</li>
    </ol>
        <!--<div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>-->
    @if (Auth::user()->id_jabatan == '1')
    <a href="{{route('tambah_pengeluaran')}}"class="btn btn-primary">Tambah Pengeluaran</a>
    @endif
    <div class="card mb-4">
        <!-- <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div> -->
<!-- View Data -->
        <!-- Modal -->
        @foreach ($query as $row)
        <div class="modal fade" id="view{{$row->id_pengeluaran}}" tabindex="-1" role="dialog" aria-labelledby="view{{$row->id_pengeluaran}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="id_pengeluaran{{$row->id_pengeluaran}}">Detail {{$row->tanggal_pengeluaran}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none"></div>
                            <div class="form-group">
                                <label>User Id</label>
                                <input type="number" name="user_id" id="user_id" class="form-control" value="{{$row->user_id}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" name="tanggal_pengeluaran" id="tanggal_pengeluaran" class="form-control" value="{{$row->tanggal_pengeluaran}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Pengeluaran</label>
                                <input type="text" name="jumlah_pengeluaran" id="jumlah_pengeluaran" class="form-control" value="Rp{{number_format($row->jumlah_pengeluaran)}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{$row->keterangan}}" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- END Modal -->
                <!-- END View data -->
                <!-- Edit Data -->
        <!-- Modal -->
        @foreach ($query as $row)
        <div class="modal fade" id="id{{$row->id_pengeluaran}}" tabindex="-1" role="dialog" aria-labelledby="id_pengeluaran{{$row->id_pengeluaran}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="id_pengeluaran{{$row->id_pengeluaran}}">Edit {{$row->tanggal_pengeluaran}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none"></div>
                        <form action="{{route('update.pengeluaran',$row->id_pengeluaran)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Jumlah Pengeluaran</label>
                                <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaran" class="form-control" value="{{$row->jumlah_pengeluaran}}" required>
                                <input type="text" name="id_pengeluaran" value="{{$row->id_pengeluaran}}" hidden>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control overflow-auto" name="keterangan" id="keterangan" rows="3" value="{{$row->keterangan}}" placeholder="Cth: Pengeluaran biaya operasional">{{$row->keterangan}}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="formSubmit">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        <!-- END Modal -->
                <!-- END Edit data -->
 <!-- Session Alert -->
 @if(session('success'))
 <p class="alert alert-success">{{ session('success') }}</p>
 @endif
 @if (session('error'))
 <p class="alert alert-danger">{{ session('error') }} </p>
 @endif
 <!-- END Session Alert -->
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
        @foreach ($query as $row)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$row->nim}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($row->tanggal_pengeluaran))}}</td>
                        <td>Rp{{number_format($row->jumlah_pengeluaran)}}</td>
                        <td>{{$row->keterangan}}</td>
                         <td>
                            <a href="" class="text-success" title="View" data-bs-toggle="modal" data-bs-target="#view{{$row->id_pengeluaran}}"><i class="fas fa-eye">&#xE254;</i></a>
                            @if(Auth::user()->id_jabatan == '1')
                            <a href="" class="text-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#id{{$row->id_pengeluaran}}"><i class="fas fa-edit">&#xE254;</i></a>
                            <a class="text-danger" href="{{route('delete.pengeluaran',['id_pengeluaran' => $row->id_pengeluaran])}}" onclick="return confirm('Tekan OK Untuk Menghapus')" title="Delete" data-toggle="tooltip"><i class="fa fa-trash">&#xE872;</i></a>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection