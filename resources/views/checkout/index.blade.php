@extends('layouts.app')

@section('content')
<section id="aa-catg-head-banner">
    <img src="{{ asset('img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
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
                                 <input type="number" placeholder="Nomor Telepon Anda" name="no_telepon" class="form-control" value="{{ $detail['no_telepon'] }}" required>
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
                                  <input type="text" placeholder="Kota Anda" name="kota" class="form-control" value="{{ $detail['kota'] }}" required>
                                </div>
                              </div>                         
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Kode Pos Anda" name="kode_pos" class="form-control" value="{{ $detail['kode_pos'] }}" required>
                                </div>
                              </div>                         
                           </div>   
                           <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                      <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                      <option value="Laki-Laki" @if(isset($user['jenis_kelamin']) && $user['jenis_kelamin'] == "Laki-Laki") selected @endif>Laki-Laki</option>
                                      <option value="Perempuan" @if(isset($user['jenis_kelamin']) && $user['jenis_kelamin'] == "Perempuan") selected @endif>Perempuan</option>
                                  </select>
                                </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill" required>
                                  <textarea cols="8" rows="3" name="alamat" placeholder="Alamat Anda" class="form-control"></textarea>
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
                 <div class="checkout-right">
                   <h4>Konfirmasi Pesanan</h4>
                   <div class="aa-payment-method text-center"> 
                     <button type="button" class="btn btn-success text-center" id="confirm-pesanan">Konfirmasi Pesanan Sekarang!</button>
                   </div>
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
                                <td colspan="8" class="text-center text-danger">Tidak Ada Produk Pada Wishlist Anda</td>
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
      swal({
          title: "Apakah Anda Yakin",
          text: "Konfirmasi Pesanan Anda Sekarang?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, konfirmasi sekarang!",
          closeOnConfirm: false,
      }, function() {
          $.ajax({
              url: "{{ route('checkout.confirm') }}",
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                if(response.status == true){
                  swal("Success!", "Berhasil Konfirmasi Pesanan Anda!.", "success");
                  setInterval(() => {
                    window.location.href = "{{ route('home') }}";
                  }, 1000);
                }else{
                  swal("Gagal!", "Gagal Konfirmasi Pesanan Anda! Mungkin Sudah Terkonfirmasi.", "warning");
                }
              },
              error: function(xhr) {
                  swal("Error!", "An error occurred while deleting the wishlist item.", "error");
              }
          });
      });
    })
  })
</script>
@stop