@extends('dashboard.layout.main')

@section('container')

<div class="container">
    <h1 class="mt-3 mb-3">Halaman Analisa</h1>


<!-- Project Card Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Analisa transaksi : {{ date('l, d M Y -') }} <span id="jam"></span></h6>
    </div>
    <div class="card-body">
        <?php $i= 0 ?>

        @foreach ($allTransaksi as $stransaksi)
            <?php $i++ ?>
        @endforeach

        <h4 class=" font-weight-bold">Total Transaksi : <span
                class="float-right">{{ $i }}</span></h4>
        <hr>

        {{-- Analisa Pesanan --}}

        <?php $p = 0 ?>
        @foreach ($pesanan as $pe)
            <?php $p++ ?>
        @endforeach 
        <?php $p = $p/$i*1*100?>

        <h4 class="small font-weight-bold">Pesanan <span
                class="float-right">{{ round($p) }}%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($p) }}%"
                aria-valuenow="{{ round($p) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        
        {{-- Analisa Cancel --}}

        <?php $c = 0 ?>
        @foreach ($cancel as $can)
            <?php $c++ ?>
        @endforeach 
        <?php $c = $c/$i*1*100?>

        <h4 class="small font-weight-bold">Cencel <span
                class="float-right">{{ round($c) }}%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ round($c) }}%"
                aria-valuenow="{{ round($c) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    window.onload = function() { jam(); }
   
    function jam() {
     var e = document.getElementById('jam'),
     d = new Date(), h, m, s;
     h = d.getHours();
     m = set(d.getMinutes());
     s = set(d.getSeconds());
   
     e.innerHTML = h +':'+ m +':'+ s;
   
     setTimeout('jam()', 1000);
    }
   
    function set(e) {
     e = e < 10 ? '0'+ e : e;
     return e;
    }
</script>

@endsection
