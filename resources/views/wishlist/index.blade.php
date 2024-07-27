@extends('layouts.app')
@section('content')

<section id="aa-catg-head-banner">
    <img src="{{ asset('img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Wishlist Page</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>                   
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
                          <td><a href="#"><img src="{{asset('img/man/polo-shirt-1.png')}}" alt="img"></a></td>
                          <td><a class="aa-cart-title" href="#">{{ $dt['nama_barang'] }}</a></td>
                          <td>{{ $dt['variasi'] }}</td>
                          <td>{{ $dt['ukuran'] }}</td>
                          <td>Rp {{ $dt['harga'] }}</td>
                          <td>{{ $dt['qty'] }}</td>
                          <td>
                            <button type="button" class="btn btn-success" id="btn-cart" onclick="addCart(`{{ $dt['id'] }}`, `{{ $dt['uuid'] }}`, `{{ $dt['variant_id'] }}`)"><fa class="fa fa-cart"></fa> Tambahkan Ke Keranjang</button>
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
</script>
@stop