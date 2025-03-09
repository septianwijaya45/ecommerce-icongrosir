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
