<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Laporan Pemasukkan</title>
		<!--bootstrap-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		 <!-- Link CSS public/css-->
		 <link rel="stylesheet" href="{{asset('styles.css')}}">
		 <!-- Link javascript public/scripts.js-->
<script type="text/javascript" src="{{asset('scripts.js')}}"></script>
						 <!-- Link javascript public/datatables-simple-demo.js-->
<script type="text/javascript" src="{{asset('datatables-simple-demo.js')}}"></script>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>



</head>
<body>
	@foreach ($query->take(1) as $row)
		<div id="btnprint" class="container mt-3">
				<h2 class="text-center mb-3 mt-2">Laporan Pemasukkan</h2>
				<p class="text-secondary">Laporan pada bulan: {{ucwords($row->nama_bulan)}} | Tahun: {{$row->tahun}} | Pembayaran: Rp{{number_format($row->nominal_bulanan)}}<span><small>/bulan</small></span></p>
				@endforeach

				<table class="table table-bordered" id="datatablesSimple">
					<thead>
						<tr>
							<th>No</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Terbayar</th>
							<th>Status Lunas</th>
						</tr>
					</thead>
					<tbody>
						@php $no=1; @endphp
						@foreach ($query as $row)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$row->nim}}</td>
							<td>{{$row->name}}</td>
							@if($row->terbayar == $row->nominal_bulanan)
									<td class="text-success">Rp{{number_format($row->terbayar)}}</td>
									@else
									<td class="text-danger">Rp{{number_format($row->terbayar)}}</td>
							@endif
							@if($row->status_lunas == '1')
									<td class="text-success">SUDAH LUNAS</td>
									@else
									<td class="text-danger">BELUM LUNAS</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="row mb-1">
					<div class="col-lg-4">
						<p>Total Pemasukkan: Rp{{number_format($sum)}},- </p>
					</div>
				</div>
			</div>
			<div class="container mb-1">
					<button onclick="printDiv('btnprint')" class="btn btn-outline-primary"><i class="fas fa-fw fa-print"></i>Print</button>
					<a class="btn btn-danger" href="{{ route('laporan') }}">Back</a>

			</div>
			<script>
			function printDiv(btnprint){
			var printContents = document.getElementById(btnprint).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
			</script>
			</body>
			</html>
