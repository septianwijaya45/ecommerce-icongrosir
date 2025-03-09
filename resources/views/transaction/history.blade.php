@extends('layouts.app')
@section('content')

@if(session('error'))
<div class="alert alert-danger text-white text-center">
    {{ session('error') }}
</div>
@endif
@if(session('success'))
<div class="alert alert-success text-white text-center">
    {{ session('success') }}
</div>
@endif

@php
    $setting = getSetting();
@endphp

<section id="aa-catg-head-banner">
    @foreach($banners as $banner)
      @if (strpos($banner['name_menu_banner'], 'pesanan_saya') !== false)
        <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
      @endif
    @endforeach
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Pesanan Saya</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Pesanan Saya</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section id="cart-view" style="margin-bottom: 30px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                        <div class="card">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    {{-- INI DETAIL --}}
                                    <h4>Detail Pesanan Saya</h4>
                                    <table id="transactionTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Transaksi</th>
                                                <th>Tanggal Dipesan</th>
                                                <th>Total Product</th>
                                                <th>Detail Product</th>
                                                <th>Total Harga</th>
                                                <th>Status Konfirmasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($historyTransaction as $index => $transaction)

                                                @php
                                                    $message = "Hallo Permisi,\n";
                                                    $message .= "Saya " . $transaction['name'] . " ingin memesan produk yang sudah saya checkout melalui aplikasi website icongrosir.com dengan detail ini:\n";

                                                    $message .= "Nomor Order:".$transaction['kode_invoice']."\n";
                                                    $message .= "Ekspedisi yang Dipilih:".$transaction['ekspedisi']."\n";
                                                    foreach ($transaction['products'] as $index => $product) {
                                                        $message .= ($index + 1) . ". " . $product['nama_barang'] . " (" . $product['variasi'] . ") - " . $product['warna'] . " | ukuran: " . $product['ukuran'] . " sebanyak Qty: " . $product['qty'] . "\n";
                                                    }

                                                    $message .= "\nMohon bisa diproses di alamat saya ya:\n";
                                                    $message .= $transaction['alamat'] . "\n";
                                                    $message .= "\nTerima Kasih";

                                                    $message = urlencode($message);
                                                    $no = 0;
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $no +=1 }}</td>
                                                    <td>{{ $transaction['kode_invoice'] }}</td>
                                                    <td>{{ $transaction['tanggal_pesan'] }}</td>
                                                    <td>{{ count($transaction['products']) }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($transaction['products'] as $product)
                                                                <li>{{ $product['nama_barang'] }} (Qty: {{ $product['qty'] }})</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>Rp{{ number_format($total_harga, 2, ',', '.') }}</td>
                                                    <td>
                                                        @if($transaction['konfirmasi_admin'] == 1)
                                                            <span class="text-success">Terkonfirmasi</span>
                                                        @else
                                                            <span class="text-danger">Belum Dikonfirmasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="https://api.whatsapp.com/send?phone={{ convertPhoneToInternational($setting['no_telp']) }}&text={{ $message }}" class="btn btn-success" target="_blank">Kirim Pesan WA</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#transactionTable').DataTable();
    });
</script>
@stop
