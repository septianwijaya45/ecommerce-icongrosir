@extends('layouts.app')

@section('content')
<section id="aa-catg-head-banner">
    <img src="{{ asset('img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Cart Page</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>                   
                    <li class="active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                          <th></th>
                          <th></th>
                          <th>Produk</th>
                          <th>Varian</th>
                          <th>Ukuran</th>
                          <th>Harga Satuan</th>
                          <th>Qty</th>
                       </tr>
                     </thead>
                     <tbody>
                        @php
                          $total = 0;
                        @endphp
                        @forelse($carts as $data)
                        @php
                          $total += $data['harga']*$data['qty'];
                        @endphp

                          <tr>
                            <td><button type="button" class="btn btn-danger" id="btn-delete" onclick="deleteData(`{{ $data['id'] }}`)"><fa class="fa fa-trash"></fa></button></td>
                            <td><a href="#"><img src="{{asset('img/man/polo-shirt-1.png')}}" alt="img"></a></td>
                            <td><a class="aa-cart-title" href="#">{{ $data['nama_barang'] }}</a></td>
                            <td>{{ $data['variasi'] }}</td>
                            <td>{{ $data['ukuran'] }}</td>
                            <td>{{ formatRupiah($data['harga']) }}</td>
                            <td width="10%"> <input type="number" class="form-control" value="{{ $data['qty'] }}" placeholder="QTY Dipesan" id="qty" data-id="{{ $data['id'] }}" data-product="{{ $data['product_id'] }}" data-variant="{{ $data['variant_id'] }}"> </td>
                          </tr> 
                        @empty
                          <tr>
                            <td colspan="8" class="text-center text-danger">Tidak Ada Produk Pada Wishlist Anda</td>
                          </tr> 
                        @endforelse 
                      </tbody>
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Total Biaya di Keranjang Anda</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Total</th>
                      <td id="totalHarga">{{ formatRupiah($total) }}</td>
                    </tr>
                  </tbody>
                </table>
                <a href="{{ route('checkout.store') }}" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
 
@stop
@section('script')
<script>
  function deleteData(id){
    swal({
        title: "Apakah Anda Yakin",
        text: "Hapus Cart Anda?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        closeOnConfirm: false,
    }, function() {
        $.ajax({
            url: "{{ route('cart.delete', ':id') }}".replace(':id', id),
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              swal("Success!", "Berhasil Hapus Cart Anda!.", "success");
              setInterval(() => {
                window.location.reload();
              }, 1000);
            },
            error: function(xhr) {
                swal("Error!", "An error occurred while deleting the wishlist item.", "error");
            }
        });
    });
  }
</script>
<script>
  $(document).ready(function(){
    $('#qty').change(function(){
      let id = $(this).data('id')
      let product = $(this).data('product')
      let variant = $(this).data('variant')
      $.ajax({
            url: "{{ route('cart.update',[':id', ':uuid', ':variant_id']) }}".replace(':id', id).replace(':uuid', product).replace(':variant_id', variant),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                qty: $(this).val()
            },
            success: function(response) {
              if(response.status == true){
                swal("Success!", "Berhasil Update Qty Pesanan Anda!.", "success");
                $('#totalHarga').html(response.totalHarga)
              }else{
                swal("Gagal!", "Gagal Update Qty Pesanan Anda!.", "error");
              }
            },
            error: function(xhr) {
                swal("Error!", "An error occurred while deleting the wishlist item.", "error");
            }
        });
    })
  })
</script>
@stop