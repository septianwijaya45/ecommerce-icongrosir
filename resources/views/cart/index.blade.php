@extends('layouts.app')

@section('content')
<section id="aa-catg-head-banner">
  @foreach($banners as $banner)
    @if (strpos($banner['name_menu_banner'], 'cart') !== false)
      <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
    @endif
  @endforeach
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
                          <th>Produk</th>
                          <th>Varian</th>
                          <th>Warna</th>
                          <th>Ukuran</th>
                          <th>Harga Satuan</th>
                          <th>Qty</th>
                       </tr>
                     </thead>
                        <tbody id="list-product">
                            @php
                            $total = 0;
                            @endphp
                            @forelse($carts as $data)
                            @php
                            $total += $data['hargas']*$data['qty'];
                            @endphp

                                <tr>
                                    <td><button type="button" class="btn btn-danger" id="btn-delete" onclick="deleteData(`{{ $data['id'] }}`)"><fa class="fa fa-trash"></fa></button></td>
                                    <td>
                                        <a href="#">
                                            <img src="{{ !is_null($data['image']) ? $urlPhoto.$data['image'] : 'img/default/defaultProduct.png'}}" alt="img">
                                        </a>
                                        <br>
                                        <p>{{ $data['nama_barang'] }}</p>
                                    </td>
                                    <td>
                                    <select class="form-control" id="variant-{{ $data['id'] }}" onchange="loadVariant(`{{ $data['uuid'] }}`, this.value, `{{ $data['id'] }}`)" name="variant" readonly>
                                        <option value="">Pilih Varian</option>
                                        @foreach($data['variants'] as $variant)
                                        <option value="{{ $variant['variasi_detail'] }}" @if($variant['variasi_detail'] == $data['varian']) selected @endif>{{ $variant['variasi_detail'] }}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                    <select class="form-control" id="warna-{{ $data['id'] }}" onchange="loadColors(`{{ $data['uuid'] }}`, this.value, `{{ $data['id'] }}`)" name="warna" readonly>
                                        <option value="">Pilih Warna</option>
                                        @foreach($data['warnas'] as $warna)
                                        <option value="{{ $warna['warna'] }}" @if($warna['warna'] == $data['warna']) selected @endif>{{ $warna['warna'] }}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                    <select class="form-control" id="ukuran-{{ $data['id'] }}" onchange="loadSizes(`{{ $data['uuid'] }}`, this.value, `{{ $data['id'] }}`)" name="ukuran" readonly>
                                        <option value="">Pilih Ukuran</option>
                                        @foreach($data['ukurans'] as $ukuran)
                                        <option value="{{ $ukuran['ukuran'] }}" @if($ukuran['ukuran'] == $data['ukuran']) selected @endif>{{ $ukuran['ukuran'] }}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>{{ formatRupiah($data['hargas']) }}</td>
                                    <td width="10%">
                                        <input type="number" class="form-control" value="{{ $data['qty'] }}" placeholder="QTY Dipesan" onchange="changeQty(`{{ $data['uuid'] }}`, this.value, `{{ $data['id'] }}`)" oninput="changeQty(`{{ $data['uuid'] }}`, this.value, `{{ $data['id'] }}`)" id="qty-{{ $data['id'] }}" data-id="{{ $data['id'] }}" data-product="{{ $data['product_id'] }}" data-variant="{{ $data['variant_id'] }}">
                                    </td>
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
              @if(count($carts) > 0)
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
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@stop

@section('script')
<script type="text/javascript">

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
            swal({
                title: "Loading...",
                text: "Proses Hapus List Keranjang Anda!",
                type: "warning",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                allowOutsideClick: false
            });

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


    function changeQty(product_id, qty, cart){
        let variant = $('#variant-'+cart).val()
        let ukuran = $('#ukuran-'+cart).val()
        let warna = $('#warna-'+cart).val()
        if(qty < 1){
            $('#qty-'+cart).val(1)
        }else{
            $.ajax({
                url: "{{ route('cart.update',[':id', ':uuid', ':variant_id']) }}".replace(':id', cart).replace(':uuid', product_id).replace(':variant_id', variant),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    qty: $('#qty-'+cart).val()
                },
                success: function(response) {
                if(response.status == true){
                    console.log(response.stokKurang)
                    if(response.stokKurang == true){
                        swal("Warning!", response.message, "warning");
                        $('#totalHarga').html(response.totalHarga)
                    }else{
                        swal("Success!", response.message, "success");
                        $('#totalHarga').html(response.totalHarga)
                        $('#qty-'+cart).val(response.newQty)
                    }
                }else{
                    swal("Gagal!", "Gagal Update Qty Pesanan Anda! Mungkin QTY Melebihi Stok Toko!.", "error");
                    $('#qty-'+cart).val(response.newQty)
                }
                },
                error: function(xhr) {
                    swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
                }
            })
        }
    }

</script>
@stop
