@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href={{ route('home') }}>Dashboard</a></li>
            <li class="breadcrumb-item active">Detail Anggota</li>
        </ol>
        <div class="col-sm text-right">
            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p class="alert alert-danger">{{ session('error') }} </p>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <a href="{{ route('tambah_anggota') }}"class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Anggota</a>

            <div class=card mb-4">
                <!-- <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div> -->
                <!-- View Data -->
                <!-- Modal -->
                @foreach ($query as $row)
                    <div class="modal fade" id="view{{ $row->id_anggota }}" tabindex="-1" role="dialog"
                        aria-labelledby="view{{ $row->id_anggota }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="id_pengeluaran{{ $row->id_anggota }}">Detail
                                        {{ $row->name }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" id="email" class="form-control"
                                            value="{{ $row->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text" name="nim" id="nim" class="form-control"
                                            value="{{ $row->nim }}" readonly>
                                        <div class="text-danger">
                                            @error('nim')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ $row->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                            value="{{ $row->no_telepon }}" readonly>
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
                    <div class="modal fade" id="id{{ $row->id_anggota }}" tabindex="-1" role="dialog"
                        aria-labelledby="id_pengeluaran{{ $row->id_anggota }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="id_pengeluaran{{ $row->id_anggota }}">Edit
                                        {{ $row->name }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" style="display:none"></div>
                                    <form action="{{ route('update.anggota', $row->id_anggota) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" id="email" class="form-control"
                                                value="{{ $row->name }}">
                                            <div class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>NIM</label>
                                            <input type="text" name="nim" id="nim" class="form-control"
                                                value="{{ $row->nim }}">
                                            <div class="text-danger">
                                                @error('nim')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                value="{{ $row->email }}">
                                            <div class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                                value="{{ old('no_telepon', $row->no_telepon) }}">
                                            <div class="text-danger">
                                                @error('no_telepon')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="formSubmit">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- END Modal -->
                <!-- END Edit data -->
                <div class="card-body">
                    <table class="table table-striped" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php $no=1; @endphp
                                @foreach ($query as $row)
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nim }}</td>
                                    <td>{{ $row->no_telepon }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td><a href="" class="text-success" title="View" data-bs-toggle="modal"
                                            data-bs-target="#view{{ $row->id_anggota }}"><i
                                                class="fas fa-eye">&#xE254;</i></a>
                                        @if (Auth::user()->id_jabatan == '1')
                                            <a href="" class="text-primary" title="Edit" data-bs-toggle="modal"
                                                data-bs-target="#id{{ $row->id_anggota }}"><i
                                                    class="fas fa-edit">&#xE254;</i></a>
                                            <!-- <a class="text-danger" href="{{-- {{route('anggota',$row->id_anggota)}} --}}" title="Delete" data-toggle="tooltip"><i class="fa fa-trash">&#xE872;</i></a>-->
                                            <a class="text-danger"
                                                href="{{ route('delete.anggota', ['id_anggota' => $row->id_anggota]) }}"
                                                onclick="return confirm('Tekan OK Untuk Menghapus')" title="Delete"
                                                data-toggle="tooltip"><i class="fa fa-trash">&#xE872;</i></a>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
