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
<section id="aa-catg-head-banner">

    @foreach($banners as $banner)
      @if (strpos($banner['name_menu_banner'], 'wishlist') !== false)
        <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
      @endif
    @endforeach
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Wishlist Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('home') }}">Home</a></li>
           <li class="active">Wishlist</li>
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
          <div class="cart-view-table aa-wishlist-table">
            <form action="">
              @if(session('error'))
                  <div class="alert alert-danger text-white">
                      {{ session('error') }}
                  </div>
              @endif
              @if(session('success'))
                  <div class="alert alert-success text-white">
                      {{ session('success') }}
                  </div>
              @endif
              <div class="table-responsive">
                 <table class="table">
                   <thead>
                     <tr>
                       <th></th>
                       <th></th>
                       <th>Produk</th>
                       <th>Varian</th>
                       <th>Warna</th>
                       <th>Ukuran</th>
                       <th>Harga</th>
                       <th>QTY Dibeli</th>
                       <th></th>
                     </tr>
                   </thead>
                   <tbody>
                      @forelse($data as $dt)
                      <tr>
                        <td><button type="button" class="btn btn-danger" id="btn-delete" onclick="deleteData(`{{ $dt['id'] }}`)"><fa class="fa fa-trash"></fa></button></td>
                        <td><a href="#"><img src="{{ $dt['image'] != null ?  $photoUrl.$dt['image'] : asset('img/man/polo-shirt-1.png') }}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{ $dt['nama_barang'] }}</a></td>
                        <td>
                          <select class="form-control" id="variant-{{ $dt['uuid'] }}" onchange="loadVariant(`{{ $dt['uuid'] }}`, this.value, `{{ $dt['id'] }}`)" name="variant">
                            <option value="">Pilih Varian</option>
                            @foreach($dt['variants'] as $variant)
                              <option value="{{ $variant['variasi_detail'] }}" @if($dt['varian'] == $variant['variasi_detail']) selected @endif>{{ $variant['variasi_detail'] }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select class="form-control" id="warna-{{ $dt['uuid'] }}" onchange="loadColors(`{{ $dt['uuid'] }}`, this.value, `{{ $dt['id'] }}`)" name="warna">
                            <option value="">Pilih Warna</option>
                            @foreach($dt['warnas'] as $warna)
                              <option value="{{ $warna['warna'] }}" @if($dt['warna'] == $warna['warna']) selected @endif>{{ $warna['warna'] }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select class="form-control" id="ukuran-{{ $dt['uuid'] }}" onchange="loadSizes(`{{ $dt['uuid'] }}`, this.value, `{{ $dt['id'] }}`)" name="ukuran">
                            <option value="">Pilih Ukuran</option>
                            @foreach($dt['ukurans'] as $ukuran)
                              <option value="{{ $ukuran['ukuran'] }}" @if($dt['ukuran'] == $ukuran['ukuran']) selected @endif>{{ $ukuran['ukuran'] }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="text" id="harga-{{ $dt['uuid'] }}" name="harga" class="form-control" value="{{ $dt['price'] }}" readonly>
                        </td>
                        <td>
                          <input type="number" min="1" id="qty-{{ $dt['uuid'] }}" onchange="changeQty(`{{ $dt['uuid'] }}`, this.value, `{{ $dt['id'] }}`)" oninput="changeQty(`{{ $dt['uuid'] }}`, this.value, `{{ $dt['id'] }}`)" name="qty" value="{{ $dt['qty'] }}" class="form-control">
                        </td>
                        <td>
                          <button type="button" class="btn btn-success" id="btn-cart" onclick="addCart(`{{ $dt['id'] }}`, `{{ $dt['uuid'] }}`, `{{ $dt['variant_id'] }}`)"><fa class="fa fa-cart"></fa> Add to cart</button>
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
        text: "Hapus Wishlish Anda?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
    }, function() {
        swal({
            title: "Loading...",
            text: "Proses Menghapus Wishlist Anda..",
            type: "warning",
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            allowOutsideClick: false
        });
        $.ajax({
            url: "{{ route('wishlist.delete', ':id') }}".replace(':id', id),
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              swal("Success!", "Berhasil Hapus Wishlist Anda!.", "success");
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

  function addCart(id, uuid, variant){
    swal({
        title: "Apakah Anda Yakin",
        text: "Tambahkan Ke Keranjang Anda?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Tambahkan!",
        closeOnConfirm: false,
    }, function() {

        swal({
            title: "Loading...",
            text: "Proses Ke Keranjang Anda!",
            type: "warning",
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            allowOutsideClick: false
        });

        $.ajax({
            url: "{{ route('cart.store', [':id', ':uuid', ':variant_id']) }}".replace(':id', id).replace(':uuid', uuid).replace(':variant_id', variant),
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              swal("Success!", "Berhasil Menambahkan Ke Keranjang Anda!.", "success");
              setInterval(() => {
                window.location.reload();
              }, 1000);
            },
            error: function(xhr) {
                swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
            }
        });
    });
  }

  function loadVariant(product_id, variant, wishlist){
    $.ajax({
      url: `{{ route('getWarnaProduct', [':product_id', ':variant', ':wishlist']) }}`.replace(':product_id', product_id).replace(':variant', variant).replace(':wishlist', wishlist),
      type: 'GET',
      data: {
          _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        let options = '<option value="">Pilih Warna</option>';
        response.forEach(color => {
                options += `<option value="${color.warna}">${color.warna}</option>`;
            });
        $(`#warna-${product_id}`).html(options);
      },
      error: function(xhr) {
          swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
      }
    })
  }

  function loadColors(product_id, warna, wishlist){
    let variant = $('#variant-'+product_id).val()
    $.ajax({
      url: `{{ route('getUkuranProduct', [':product_id', ':variant', ':warna', ':wishlist']) }}`.replace(':product_id', product_id).replace(':variant', variant).replace(':warna', warna).replace(':wishlist', wishlist),
      type: 'GET',
      data: {
          _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        let options = '<option value="">Pilih Ukuran</option>';
        response.forEach(ukuran => {
                options += `<option value="${ukuran.ukuran}">${ukuran.ukuran}</option>`;
            });
        $(`#ukuran-${product_id}`).html(options);
      },
      error: function(xhr) {
          swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
      }
    })
  }

  function loadSizes(product_id, ukuran, wishlist){
    let variant = $('#variant-'+product_id).val()
    let warna = $('#warna-'+product_id).val()
    $.ajax({
      url: `{{ route('getHargaProduct', [':product_id', ':variant', ':warna', ':ukuran', ':wishlist']) }}`.replace(':product_id', product_id).replace(':variant', variant).replace(':warna', warna).replace(':ukuran', ukuran).replace(':wishlist', wishlist),
      type: 'GET',
      data: {
          _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response)
        $(`#harga-${product_id}`).val(response.harga);
      },
      error: function(xhr) {
          swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
      }
    })
  }

  function changeQty(product_id, qty, wishlist){
    let variant = $('#variant-'+product_id).val()
    let ukuran = $('#ukuran-'+product_id).val()
    let warna = $('#warna-'+product_id).val()
    if(qty < 1){
      $('#qty-'+product_id).val(1)
    }else{
      $.ajax({
        url: `{{ route('wishlist.update', [':product_id', ':variant', ':warna', ':ukuran', ':wishlist', ':qty']) }}`.replace(':product_id', product_id).replace(':variant', variant).replace(':warna', warna).replace(':ukuran', ukuran).replace(':wishlist', wishlist).replace(':qty', qty),
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
        },
        error: function(xhr) {
            swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
        }
      })
    }
  }
</script>
@stop
