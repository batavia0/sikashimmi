@include('dashboard')
@extends('layouts/app_wrap_layouts')
@section('overview')
<div class="container-fluid">

    <h1 class="mt-4">Pembayaran</h1>
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
        @if(Request::has('pay'))
        <button class="btn btn-warning" id="pay-button"><i class="fa fa-dollar-sign" aria-hidden="true"></i>
          Lanjutkan Pembayaran</button>
        <form action="" id="submitform" method="POST">
        @csrf
        <input type="hidden" name="json" id="json_callback">
        </form>
        @endif
        <div class="row gy-2">
          @if(isset($query->nim) && $query->nim)
          <div class="col-lg-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="col-auto">
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <h6>Kosong</h6>
                      </div>
                    </div>  
                </div>
            </div>
          </div>
          @else
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
                        @else
                        <form action="{{route('getpayment',$row->id_bulan_pembayaran)}}" method="GET">
                          @csrf
                          <button type="submit" onclick="return confirm('Tekan OK untuk melanjutkan')" class="btn btn-primary" name="pay"  data-toggle="tooltip" data-placement="top" title="Pembayaran"><i class="fa fa-dollar-sign" aria-hidden="true"></i>Bayar Bulan Ini</button>
                        </form>
                        @endif
                        
                    </div>
                </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snaptoken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
          send_response_to_form(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
          send_response_to_form(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
          send_response_to_form(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
      });

      function send_response_to_form(result){
        //convert JSON to String before submit
        document.getElementById('json_callback').value = JSON.stringify(result);
        //alert(document.getElementById('json_callback').value)
        $('#submitform').submit();
      }
    </script>
@endsection