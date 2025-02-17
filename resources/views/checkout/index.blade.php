@extends('layouts.app')
@php
    $setting = getSetting();
    $logoUrl = config('app.logo_app');
@endphp


@section('content')
<section id="aa-catg-head-banner">
    @foreach($banners as $banner)
        @if (strpos($banner['name_menu_banner'], 'checkout') !== false)
            <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
        @endif
    @endforeach
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Checkout Page</h2>
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="active">Checkout</li>
        </ol>
      </div>
     </div>
   </div>
</section>


<section id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="checkout-area">
           <form action="">
             <div class="row">
               <div class="col-md-8">
                 <div class="checkout-left">
                   <div class="panel-group" id="accordion">
                     <div class="panel panel-default aa-checkout-billaddress">
                       <div class="panel-heading">
                         <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                             Billing Details
                           </a>
                         </h4>
                       </div>
                       <div id="collapseOne" class="panel-collapse collapse in">
                         <div class="panel-body">
                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Nama Anda" name="name" class="form-control" value="{{ $user['name'] }}" required>
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="number" placeholder="Nomor Telepon Anda" name="no_telepon" class="form-control" value="{{ $user['no_telepon'] }}" required>
                               </div>
                             </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="email" placeholder="Email Anda" name="email" class="form-control" value="{{ $user['email'] }}" required>
                                </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Kota Anda" name="kota" class="form-control" id="kota" value="{{ !is_null($detail) ? $detail['kota'] : '' }}" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Kode Pos Anda" name="kode_pos" id="kode_pos" class="form-control" value="{{ !is_null($detail) ? $detail['kode_pos'] : '' }}" required>
                                </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill" required>
                                  <textarea cols="8" rows="3" name="alamat" placeholder="Alamat Anda" id="alamat" class="form-control">{{ !is_null($detail) ? $detail['alamat'] : ''}}</textarea>
                                </div>
                              </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                    <div class="row">
                        @if(isset($checkout[0]['kode_invoice']))
                        <div class="col-md-12">
                            <div class="checkout-right">
                              <h4>Kode Pesanan: </h4>
                              <div class="aa-payment-method text-center">
                                <p class="text-center" style="font-weight: bold">{{ $checkout[0]['kode_invoice'] }}</p>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="checkout-right">
                                <br>
                              <h4>Pilih Ekspedisi</h4>
                              <div class="aa-payment-method text-center">
                                <div class="form-group">
                                    <label for="ekspedisi_id">Pilih Ekspedisi Yang Digunakan</label>
                                    <select name="ekspedisi_id" id="ekspedisi" class="form-control">
                                        <option value="" selected disabled>Pilih Ekspedisi</option>
                                        @foreach($expeditions as $expedition)
                                            <option value="{{ $expedition['id'] }}">{{ $expedition['ekspedisi'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="checkout-right">
                                <br>
                              <h4>Konfirmasi Pesanan</h4>
                              <div class="aa-payment-method text-center">
                                <button type="button" class="btn btn-success text-center" id="confirm-pesanan">Konfirmasi Pesanan Sekarang!</button>
                              </div>
                            </div>
                        </div>
                        @endif
                    </div>
               </div>
               <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Order Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="aa-order-summary-area">
                          <table class="table table-responsive">
                            <thead>
                              <tr>
                                <th>Produk</th>
                                <th>Varian</th>
                                <th>Ukuran</th>
                                <th>QTY Dibeli</th>
                                <th>Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $total = 0;
                              @endphp
                              @forelse($checkout as $dt)
                              @php
                                $total += $dt['harga']*$dt['qty'];
                              @endphp
                              <tr>
                                <td><a class="aa-cart-title" href="#">{{ $dt['nama_barang'] }}</a></td>
                                <td>{{ $dt['variasi'] }}</td>
                                <td>{{ $dt['ukuran'] }}</td>
                                <td>{{ $dt['qty'] }}</td>
                                <td>{{ formatRupiah($dt['harga']) }}</td>
                              </tr>
                              @empty
                              <tr>
                                <td colspan="8" class="text-center text-danger">Tidak Ada Produk Untuk Diproses Pesanan Anda</td>
                              </tr>
                              @endforelse
                            </tbody>
                            <tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Subtotal:</th>
                                <td>{{ formatRupiah($total) }}</td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
             </div>
           </form>
          </div>
        </div>
      </div>
    </div>
</section>

@stop

@section('script')
<script>
  $(document).ready(function(){
    $('#confirm-pesanan').click(function(){
        let ekspedisi = $('#ekspedisi').val()
        if(ekspedisi == '' || ekspedisi == null){
            swal({
                title: "Gagal",
                text: "Ekspedisi Belum Dipilih!",
                type: "error"
            });
        }else{
            swal({
                title: "Apakah Anda Yakin",
                text: "Konfirmasi Pesanan Anda Sekarang?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, konfirmasi sekarang!",
                closeOnConfirm: false,
            }, function() {
                swal({
                    title: "Loading...",
                    text: "Proses Checkout Pesanan Anda!",
                    type: "warning",
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    allowOutsideClick: false
                });

                var kota = $('#kota').val().trim();
                var kodePos = $('#kode_pos').val().trim();
                var alamat = $('#alamat').val().trim();

                if (kota === '') {
                    swal({
                        title: "Gagal",
                        text: "Kota Belum Diisi!",
                        type: "error"
                    });
                    $('#kota').focus();
                    return false;
                }

                if (kodePos === '') {
                    swal({
                        title: "Gagal",
                        text: "Kode Pos Belum Diisi!",
                        type: "error"
                    });
                    $('#kode_pos').focus();
                    return false;
                }

                if (alamat === '') {
                    swal({
                        title: "Gagal",
                        text: "Alamat Belum Diisi!",
                        type: "error"
                    });
                    $('#alamat').focus();
                    return false;
                }

                $.ajax({
                    url: "{{ route('checkout.confirm') }}",
                    type: 'POST',
                    data: {
                            _token: '{{ csrf_token() }}',
                            ekspedisi: ekspedisi,
                            no_telp: "{{ $setting['no_telp'] }}",
                            kota: $('#kota').val(),
                            kode_pos: $('#kode_pos').val(),
                            alamat: $('#alamat').val()
                    },
                    success: function(response) {
                        if(response.status == true){
                        swal("Success!", "Berhasil Konfirmasi Pesanan Anda!.", "success");
                        setInterval(() => {
                            window.open(response.sendMessage, '_blank');
                        }, 1000);

                        setInterval(() => {
                            window.location.href = "{{ route('pesananSaya') }}"
                        }, 5000);
                        }else{
                        swal("Gagal!", "Gagal Konfirmasi Pesanan Anda! Mungkin Sudah Terkonfirmasi.", "warning");
                        }
                    },
                    error: function(xhr) {
                        swal("Error!", "An error occurred while deleting the wishlist item.", "error");
                    }
                });
            });
        }
    })
  })
</script>
@stop
