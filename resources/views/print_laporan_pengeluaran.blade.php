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

</head>
<body>
  
    <div id="btnprint" class="container mt-3">
        <h2 class="text-center mb-3 mt-2">Laporan Pengeluaran</h2>
        <p class="text-secondary">Dari Tanggal: {{date('d-M-Y',strtotime($datefrom))}} s/d {{date('d-M-Y',strtotime($datecurrent))}} 
                   
        <table class="table table-bordered" id="table">
          <thead>
            <tr>
              <th>No</th>
              <th>User Id</th>
              <th>Jumlah Pengeluaran</th>
              <th>Tanggal Pengeluaran</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1; @endphp
            @foreach ($query as $row) 
            <tr>
              <td>{{$no++}}</td>
              <td>{{$row->user_id}}</td>
              <td>{{$row->jumlah_pengeluaran}}</td>
              <td>{{date('d-M-Y',strtotime($row->tanggal_pengeluaran))}}</td>
              <td>{{$row->keterangan}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="row mb-1">
          <div class="col lg-4 ">
            <p><span class="text text-danger">Jumlah Pengeluaran:</span> Rp{{number_format($sum)}},- </p>
            <p><span class="text text-success">Sisa Uang Kas:</span> Rp{{number_format($total-$substract)}},- </p>

          </div>
        </div>
      </div>
      <div class="container mb-1">
        <button onclick="printDiv('btnprint')" class="btn btn-outline-primary"><i class="fas fa-fw fa-print"></i>Print</button> 
        <a class="btn btn-danger" href="{{ route('laporan') }}">Back</a>
      </div>
      <script>
        $(document).ready(function() {
          function print() {
            window.print();
          }
        });
      </script>
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
</script>
</body>
</html>