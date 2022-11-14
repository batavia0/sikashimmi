@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('title')
@section('overview')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href={{route('home')}}>Dashboard</a></li>
        <li class="breadcrumb-item"><a href={{route('uang_kas')}}>Bulan</a></li>
        <li class="breadcrumb-item active">Detail Uang Kas</li>
    </ol>
        <div class="card mb-4">
        <div class="card-body">
            
            @foreach ($judul as $item)
                Data Pemasukkan {{Str::ucfirst($item->nama_bulan)}} | {{$item->tahun}} | Rp{{number_format($item->nominal_bulanan)}}
            @endforeach
        </div>
    </div>
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
        <!-- <a href=""class="btn btn-primary" title="Tambah Anggota" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fa fa-plus"></i>Tambah Anggota</a> -->
<!-- Modal Untuk Tambah Anggota -->   <!-- Modal Untuk Tambah Anggota -->  <!-- Modal Untuk Tambah Anggota -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambah">Tambah</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none"></div>
                        <form action="{{route('insertanggota',Crypt::encrypt('id_bulan_pembayaran'))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" id="tambah">
                                <label for="anggota">List Anggota</label>
                                <select name="nim" id="nim" class="form-control">
                        @foreach ($newAnggota as $row)
                                <option value="{{$row->nim}}" selected>{{$row->nim}} | {{$row->name}}</option>
                        @endforeach
                                </select>
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
<!-- END Modal Untuk Tambah Anggota -->   <!--  END Modal Untuk Tambah Anggota -->  <!-- END Modal Untuk Tambah Anggota -->

    <div class="card mb-4">
        <!-- <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div> -->
        <div class="card-body">
            <!-- Modal -->   <!-- Modal -->  <!-- Modal -->
  @foreach ($DBuangKas as $item)
  @if(Auth::user()->id_jabatan == '1')
  <div class="modal fade" id="cek{{$item->id_uang_kas}}" tabindex="-1" role="dialog" aria-labelledby="cek{{$item->id_uang_kas}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cek{{$item->id_uang_kas}}">Edit {{$item->name}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form action="{{route('update.uang_kas',$item->id_uang_kas)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Input Nominal</label>
                        <input type="number" name="terbayar" id="terbayar" class="form-control" value="{{$item->terbayar}}">
                        <input type="text" name="id_bulan_pembayaran" value="{{Crypt::encryptString($item->id_bulan_pembayaran)}}" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="formSubmit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif 
            <!--  END Modal --> <!--  END Modal --> <!--  END Modal -->
<!--<script>
    $(document).ready(function(){
        $('#formSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/books') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    auther_name: $('#auther_name').val(),
                    description: $('#description').val(),
                },
                success: function(result){
                    if(result.errors)
                    {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>'+value+'</li>');
                        });
                    }
                    else
                    {
                        $('.alert-danger').hide();
                        $('#exampleModal').modal('hide');
                    }
                }
            });
        });
    });
</script>-->
  @endforeach
           <table class="table table-striped" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Terbayar</th>
                        <th>Status Lunas</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach ($DBuangKas as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->nim}}</td>
                        <td>{{$item->name}}</td>
                        <td><!-- Button trigger modal -->
                                <a href="" class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#cek{{$item->id_uang_kas}}">{{$item->terbayar}}</a></td>
                        @if ($item->status_lunas == '1')
                            <td class="text text-success">SUDAH LUNAS</td>
                            @else
                            <td class="text text-danger">BELUM LUNAS</td>
                            @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection