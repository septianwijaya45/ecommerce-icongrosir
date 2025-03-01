@extends('layouts.app')

@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
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
    @foreach($banners as $banner)
      @if (strpos($banner['name_menu_banner'], 'katalog') !== false)
        <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
      @endif
    @endforeach
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>{{ $product['nama_barang'] }}</h2>
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="#">Product</a></li>
          <li class="active">{{ $product['nama_barang'] }}</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <div class="aa-product-view-slider">
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        @if(count($photo) != 0)
                            @if (!str_ends_with($photo[0]['nama_file'], '.mp4'))
                                <div class="simpleLens-big-image-container">
                                    <a href="#aa-product-details" data-lens-image="{{ $photoUrl.$photo[0]['nama_file'] }}" class="simpleLens-lens-image">
                                        <img src="{{ $photoUrl.$photo[0]['nama_file'] }}" class="simpleLens-big-image">
                                    </a>
                                </div>
                            @else
                                <div class="simpleLens-big-image-container">
                                    <a href="#aa-product-details" data-lens-image="{{ $videoUrl.$photo[0]['nama_file'] }}" class="simpleLens-lens-image">
                                        <video width="250" height="300" class="simpleLens-big-image">
                                            <source src="{{ $videoUrl.$photo[0]['nama_file'] }}" type="video/mp4" >
                                        </video>
                                    </a>
                                </div>
                            @endif
                        @else
                          <div class="simpleLens-big-image-container"><a href="#aa-product-details" data-lens-image="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-lens-image"><img src="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-big-image"></a></div>
                        @endif
                      </div>
                      <div class="simpleLens-thumbnails-container">
                        @if(count($photo) != 0)
                          @foreach($photo as $foto)
                            @if(!Str::endsWith($foto['nama_file'], '.mp4'))
                                {{-- Jika bukan .mp4 --}}
                                <a href="#aa-product-details" data-big-image="{{ $photoUrl.$foto['nama_file'] }}" data-lens-image="{{ $photoUrl.$foto['nama_file'] }}" class="simpleLens-thumbnail-wrapper">
                                    <img src="{{ $photoUrl.$foto['nama_file'] }}" width="50px">
                                </a>
                            @else
                                <a href="#aa-product-details" data-big-image="{{ $videoUrl.$foto['nama_file'] }}" data-lens-image="{{ $videoUrl.$foto['nama_file'] }}" class="simpleLens-thumbnail-wrapper">
                                    <img src="{{ asset('img/play-button.png') }}" width="50px">
                                </a>
                            @endif
                          @endforeach
                        @else
                          <br>
                          <a href="#aa-product-details" data-big-image="{{ asset('img/products/image-not-found.jpg') }}" data-lens-image="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-thumbnail-wrapper" >
                            <img src="{{ asset('img/products/image-not-found.jpg') }}" width="50px">
                          </a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{ $product['nama_barang'] }}</h3>
                    <div class="aa-price-block">
                        <span class="aa-product-view-price" id="harga-product">Rp {{ $product['harga'] }}</span>
                        <p class="aa-product-avilability">Stok:  @if($productDetail[0]['t_stok_details']['stock'] != 0) <span class="text-success" id="stock-data">Tersedia</span>@else <span class="text-danger">Tidak Ada</span>  @endif</p>
                    </div>
                    <h4>Varian</h4>
                    <div class="aa-prod-view-size">
                        <select id="varian"  name="varian" class="form-control">
                            <option value="" selected>Silahkan Pilih Varian</option>
                            @foreach($variants as $variant)
                                <option value="{{$variant['variasi_detail']}}">{{$variant['variasi_detail']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h4>Warna</h4>
                    <div class="aa-color-tag">
                        <select id="warna" name="warna" class="form-control">
                            <option value="" selected>Silahkan Pilih Varian Terlebih Dahulu</option>
                        </select>
                    </div>
                    <h4>Ukuran</h4>
                    <div class="aa-prod-view-size">
                        <select id="ukuran"  name="ukuran" class="form-control">
                            <option value="" selected>Silahkan Pilih Varian Terlebih Dahulu</option>
                        </select>
                    </div>
                    <div class="aa-prod-quantity">
                      <input type="text" id="qty" placeholder="QTY Pesanan" class="form-control">
                      <p class="aa-prod-category">
                        Category:  <a href="#">{{ $category['category'] }}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <button type="button" class="aa-add-to-cart-btn" id="cart" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif> Add To Cart</button>
                      <button type="button" class="aa-add-to-cart-btn" id="wishlist" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif>Wishlist</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>
                    @if(!is_null($product['deskripsi']))
                      {{$product['deskripsi']}}
                    @else
                      <span class="text-danger">Tidak Ada Deskripsi</span>
                    @endif
                  </p>
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>{{ count($productReviews) }} Reviews for {{ $product['nama_barang'] }}</h4>
                   <ul class="aa-review-nav">
                      @forelse($productReviews as $productReview)
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="{{ asset('img/default/user.png') }}" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>{{ $productReview->name }}</strong> - <span>{{ date('d F Y', strtotime($productReview->createdAt)) }}</span></h4>
                            <div class="aa-product-rating">
                              @if (isset($rating) && $rating <= 5)
                                  @for ($i = 1; $i <= 5; $i++)
                                      @if ($i <= $rating)
                                          <span class="fa fa-star"></span>
                                      @else
                                          <span class="fa fa-star-o"></span>
                                      @endif
                                  @endfor
                              @endif
                            </div>
                            <p>
                              @if(!is_null($productReview->review_deskripsi))
                                $productReview->review_deskripsi
                              @else
                                <span class="text-danger">Tidak Ada Deskripsi</span>
                              @endif
                            </p>
                          </div>
                        </div>
                      </li>
                      @empty
                      @endforelse
                   </ul>
                   <br><hr>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                @foreach($relatedProduct as $related)
                  <li>
                    <figure>
                        <a class="aa-product-img"><img src="{{ $related['image'] ? $photoUrl.$related['image'] : asset('img/products/image-not-found.jpg') }}"  width="250px" height="300px" alt="{{$related['nama_barang']}}"></a>
                        <a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{$related['nama_barang']}}</a></h4>
                            <span class="aa-product-price">Rp {{ $related['harga'] != null ? $related['harga'] : 0 }}</span>
                            @if($related['diskon_tipe'] != null)
                              <span class="aa-product-price"><del> {{ $related['diskon_tipe'] }} </del></span>
                            @else
                            @endif
                        </figcaption>
                    </figure>
                    <div class="aa-product-hvr-content">
                        <a @if($token == null) data-toggle="modal" data-target="#login-modal" @endif data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="{{route('getProductById', $related['uuid'])}}">Lihat Produk</a>
                    </div>
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                  </li>
                @endforeach
              </ul>
              <!-- quick view modal -->
              <!-- / quick view modal -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->

@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        function showError(pesan) {
            swal({
                title: "Warning",
                text: pesan,
                type: "warning",
                confirmButtonText: "OK"
            });
        }

        $('#varian').on('change', function(){
            $(`#warna`).html('');
            let product_id = "{{ $product_id }}";
            let varian = $(this).val();

            $.ajax({
                url: `{{ route('getWarnaProductId', [':product_id', ':varian']) }}`.replace(':product_id', product_id).replace(':varian', varian),
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    let options = '<option value="">Pilih Warna</option>';
                    response.forEach(warna => {
                        options += `<option value="${warna.warna}">${warna.warna}</option>`;
                    });
                    $(`#warna`).html(options);
                },
                error: function(xhr) {
                    swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
                }
            })
        })

        $('#warna').on('change', function(){
            $(`#ukuran`).html('');
            let product_id = "{{ $product_id }}";
            let varian = $('#varian').val();
            let warna = $(this).val();

            $.ajax({
                url: `{{ route('getUkuranProductId', [':product_id', ':varian', ':warna']) }}`.replace(':product_id', product_id).replace(':varian', varian).replace(':warna', warna),
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    let options = '<option value="">Pilih Ukuran</option>';
                    response.forEach(ukuran => {
                        options += `<option value="${ukuran.ukuran}">${ukuran.ukuran}</option>`;
                    });
                    $(`#ukuran`).html(options);
                },
                error: function(xhr) {
                    swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
                }
            })
        })

        $('#ukuran').on('change', function(){
            $(`#harga-product`).html('');
            let product_id = "{{ $product_id }}";
            let varian = $('#varian').val();
            let warna = $('#warna').val();
            let ukuran = $(this).val();

            $.ajax({
                url: `{{ route('getHargaProductId', [':product_id', ':varian', ':warna', ':ukuran']) }}`.replace(':product_id', product_id).replace(':varian', varian).replace(':warna', warna).replace(':ukuran', ukuran),
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response.stock.stock)
                    $(`#harga-product`).html('Rp. '+response.dataVarian.harga);
                    $(`#stock-data`).html(response.stock.stock);
                },
                error: function(xhr) {
                    swal("Error!", "Terdapat kesalahan saat menambahkan ke keranjang anda!", "error");
                }
            })
        })

        $('#cart').on('click', function(){
            let product_id = "{{ $product_id }}";
            let varian = $('#varian').val();
            let warna = $('#warna').val();
            let ukuran = $('#ukuran').val();
            let qty = $('#qty').val()

            if (!varian) {
                showError('Silakan pilih varian.');
            } else if (!warna) {
                showError('Silakan pilih warna.');
            } else if (!ukuran) {
                showError('Silakan pilih ukuran.');
            } else if (!qty || qty <= 0) {
                showError('Silakan masukkan jumlah yang valid.');
            }else{
                swal({
                    title: "Apakah Anda Yakin?",
                    text: "Ingin Menambahkan Produk ke Keranjang?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Tambahkan!",
                    closeOnConfirm: false
                }, function() {
                    let url = `{{ route('cart.createCartByDetailProduct', [':product_id', ':varian', ':warna', ':ukuran', ':qty']) }}`;
                        url = url.replace(':product_id', product_id)
                                .replace(':varian', varian)
                                .replace(':warna', warna)
                                .replace(':ukuran', ukuran)
                                .replace(':qty', qty);

                    swal({
                        title: "Loading...",
                        text: "Sedang Menambahkan ke Keranjang!",
                        type: "warning",
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            product_id: product_id,
                            varian: varian,
                            warna: warna,
                            ukuran: ukuran,
                            qty: qty
                        },
                        success: function(response) {

                            if(response.status == true){
                                swal({
                                    title: "Berhasil!",
                                    text: "Produk telah ditambahkan ke keranjang.",
                                    type: "success"
                                });

                                setInterval(() => {
                                    window.location.reload()
                                }, 2000);
                            }else{
                                swal({
                                    title: "Gagal!",
                                    text: response.message,
                                    type: "warning"
                                });
                            }
                        },
                        error: function(xhr) {
                            swal({
                                title: "Gagal!",
                                text: "Terjadi kesalahan saat menambahkan produk ke keranjang.",
                                type: "error"
                            });
                        }
                    });
                });
            }

        })

        $('#wishlist').on('click', function(){
            let product_id = "{{ $product_id }}";
            let varian = $('#varian').val();
            let warna = $('#warna').val();
            let ukuran = $('#ukuran').val();
            let qty = $('#qty').val()
            if(qty == ''){
                qty = 0
            }
            let routeCreateWishlist = "{{ route('wishlist.store', ':id') }}".replace(':id', product_id);

            // if (!varian) {
            //     showError('Silakan pilih varian.');
            // } else if (!warna) {
            //     showError('Silakan pilih warna.');
            // } else if (!ukuran) {
            //     showError('Silakan pilih ukuran.');
            // } else{
                swal({
                    title: "Apakah Anda Yakin?",
                    text: "Ingin Menambahkan Produk ke Wishlist?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Tambahkan!",
                    closeOnConfirm: false
                }, function() {
                    swal({
                        title: "Loading...",
                        text: "Sedang Menambahkan ke Wishlist!",
                        type: "warning",
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        allowOutsideClick: false
                    });
                    // window.location.href = `{{ route('wishlist.createWishlistByDetailProduct', [':product_id', ':varian', ':warna', ':ukuran', ':qty']) }}`.replace(':product_id', product_id).replace(':varian', varian).replace(':warna', warna).replace(':ukuran', ukuran).replace(':qty', qty)
                    window.location.href = routeCreateWishlist;
                });
            // }

        })
    })
</script>
@stop
