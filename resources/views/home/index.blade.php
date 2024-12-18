@extends('layouts.app')

@section('content')

<!-- Start slider -->
<section id="aa-slider">
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
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
        <div class="seq-screen">
            <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($banners as $banner)
            @if (strpos($banner['name_menu_banner'], 'home_banner') !== false)
                <li>
                    <div class="seq-model">
                        @if($banner['image'] != null && $banner['image'] != '')
                            <img data-seq src="{{ $urlBanner . $banner['image'] }}" alt="Men slide img" />
                        @else
                            <img data-seq src="img/fashion/fashion-header-bg-8.jpg" alt="Men slide img" />
                        @endif
                    </div>

                    <div class="seq-title">
                    <span data-seq>Dapatkan Diskon Sampai 50%</span>
                    <h2 data-seq>Icon Grosir Collection</h2>
                    <p data-seq>Kaos dengan bahan lembut dan berkualitas</p>
                    <a data-seq href="{{ route('products') }}" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                    </div>
                </li>
            @endif
            @endforeach
            </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
            <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
            <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
        </div>
    </div>
</section>
<!-- / slider -->
<!-- Start Promo section -->
<section id="aa-promo">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="aa-promo-area">
            <div class="row">
                <!-- promo left -->
                <div class="col-md-5 no-padding">
                <div class="aa-promo-left">
                    <div class="aa-promo-banner">
                    <img src="img/products/clothwanita3.jpg" alt="img">
                    <div class="aa-prom-content">
                        <span>75% Off</span>
                        <h4><a href="#">For Women</a></h4>
                    </div>
                    </div>
                </div>
                </div>
                <!-- promo right -->
                <div class="col-md-7 no-padding">
                <div class="aa-promo-right">
                    <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">
                        <img src="img/products/clothpria1.jpg" alt="img">
                        <div class="aa-prom-content">
                        <span>Exclusive Item</span>
                        <h4><a href="#">For Men</a></h4>
                        </div>
                    </div>
                    </div>
                    <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">
                        <img src="img/slider/slider8.jpg" alt="img">
                        <div class="aa-prom-content">
                        <span>Sale Off</span>
                        <h4><a href="#">On Shoes</a></h4>
                        </div>
                    </div>
                    </div>
                    <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">
                        <img src="img/products/clothkids1.jpg" alt="img">
                        <div class="aa-prom-content">
                        <span>New Arrivals</span>
                        <h4><a href="#">For Kids</a></h4>
                        </div>
                    </div>
                    </div>
                    <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">
                        <img src="img/products/bags1.jpg" alt="img">
                        <div class="aa-prom-content">
                        <span>25% Off</span>
                        <h4><a href="#">For Bags</a></h4>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="aa-product-area">
                    <div class="aa-product-inner">
                <!-- start prduct navigation -->
                        <ul class="nav nav-tabs aa-products-tab">
                            <li><a href="#men" data-category-id="{{ isset($threeCategory[0]) ? $threeCategory[0]->category : 'Mens' }}" data-toggle="tab">{{ isset($threeCategory[0]) ? $threeCategory[0]->category : 'Mens' }}</a></li>
                            <li><a href="#women" data-category-id="{{ isset($threeCategory[1]) ? $threeCategory[1]->category : 'Womens' }}" data-toggle="tab">{{ isset($threeCategory[1]) ? $threeCategory[1]->category : 'Womens' }}</a></li>
                            <li><a href="#sports" data-category-id="{{ isset($threeCategory[2]) ? $threeCategory[2]->category : 'Other' }}" data-toggle="tab">{{ isset($threeCategory[2]) ? $threeCategory[2]->category : 'Other' }}</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Start men product category -->
                            <div class="tab-pane fade in active" id="men">
                            <ul class="aa-product-catg" style="width:104%">
                                <div class="row" id="product-{{ isset($threeCategory[0]) ? str_replace(' ', '_', $threeCategory[0]->category) : 'Mens' }}" >

                                </div>
                            </ul>
                            <a class="aa-browse-btn" href="#">Lihat Semua Produk {{ isset($threeCategory[0]) ? $threeCategory[0]->category : 'Mens' }}  <span class="fa fa-long-arrow-right"></span></a>
                            </div>
                            <!-- / men product category -->
                            <!-- start women product category -->
                            <div class="tab-pane fade" id="women">
                            <ul class="aa-product-catg" style="width:104%">
                                <div class="row" id="product-{{ isset($threeCategory[1]) ? str_replace(' ', '_', $threeCategory[1]->category) : 'Womens' }}">

                                </div>
                            </ul>
                            <a class="aa-browse-btn" href="#">Lihat Semua Produk {{ isset($threeCategory[1]) ? $threeCategory[1]->category : 'Womens' }}<span class="fa fa-long-arrow-right"></span></a>
                            </div>
                            <!-- / women product category -->
                            <!-- start sports product category -->
                            <div class="tab-pane fade" id="sports">
                                <ul class="aa-product-catg" style="width:104%">
                                    <div class="row" id="product-{{ isset($threeCategory[2]) ? str_replace(' ', '_', $threeCategory[2]->category) : 'Others' }}">

                                    </div>
                                </ul>
                                <a class="aa-browse-btn" href="#">Lihat Semua Produk {{ isset($threeCategory[2]) ? $threeCategory[2]->category : 'Other' }}<span class="fa fa-long-arrow-right"></span></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->
<section id="aa-banner">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="img/slider/slider1.png" alt="fashion banner img"></a>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- popular section -->
<section id="aa-popular-category">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="aa-popular-category-area">
                <!-- start prduct navigation -->
                <ul class="nav nav-tabs aa-popular-tab" id="popular-menu">
                    <li class="active"><a href="#popular" data-toggle="tab" data-list="popular">Popular</a></li>
                    <li><a href="#featured" data-toggle="tab" data-list="featured">Featured</a></li>
                    <li><a href="#latest" data-toggle="tab" data-list="latest">Latest</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="popular">
                    <ul class="aa-product-catg" style="width:104%">
                        <div class="row" id="list-popular">

                        </div>
                    </ul>
                    <a class="aa-browse-btn" href="{{ route('products') }}">Lihat Semua Produk Kami <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / popular product category -->

                <!-- start featured product category -->
                <div class="tab-pane fade" id="featured">
                    <ul class="aa-product-catg" style="width:104%">
                        <div class="row" id="list-featured">

                        </div>
                    </ul>
                    <a class="aa-browse-btn" href="{{ route('products') }}">Lihat Semua Produk Kami <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="latest">
                    <ul class="aa-product-catg" style="width:104%">
                        <div class="row" id="list-latest">

                        </div>
                    </ul>
                    <a class="aa-browse-btn" href="{{ route('products') }}">Lihat Semua Produk Kami <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / latest product category -->
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- / popular section -->
<!-- Support section -->
<section id="aa-support">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- / Support section -->
<!-- Testimonial -->
<section id="aa-testimonial">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
                <!-- single slide -->
                <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/profile/profile1.jpg" width="150px" alt="testimonial img">
                    <span class="fa fa-quote-left aa-testimonial-quote"></span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                    <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                    </div>
                </div>
                </li>
                <!-- single slide -->
                <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/profile/profile2.jpg" width="150px" alt="testimonial img">
                    <span class="fa fa-quote-left aa-testimonial-quote"></span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                    <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                    </div>
                </div>
                </li>
                <!-- single slide -->
                <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/profile/profile3.jpg" width="150px" alt="testimonial img">
                    <span class="fa fa-quote-left aa-testimonial-quote"></span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                    <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>
</section>
@stop

@section('script')
<script>
    function addToWishlist(route) {
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
            window.location.href = route;
        });
    }

    function addToCart(route) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Ingin Menambahkan Produk ke Keranjang?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Tambahkan!",
            closeOnConfirm: false
        }, function() {
            swal({
                title: "Loading...",
                text: "Sedang Menambahkan ke Keranjang!",
                type: "warning",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                allowOutsideClick: false
            });
            window.location.href = route;
        });
    }

    function errorStock(nameProduct){
        swal({
            title: "Stok Habis",
            text: `Stok Pada Produk ${nameProduct} Habis!`,
            type: "error",
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        // ***** Product Section ***** //
        getDataEightProductFirst();
        function getDataEightProductFirst(){
            var categoryId = "{{isset($threeCategory[0]) ? $threeCategory[0]->category : 'Mens'}}"
            let urlPhoto = "{{$urlPhoto}}"
            var productHtml = '';
            $.ajax({
                url: "{{ route('getEightProductByCategories', ['categoryId' =>  isset($threeCategory[0]) ? $threeCategory[0]->category : 'Mens' ]) }}", // Ganti dengan URL endpoint Anda
                method: 'GET',
                success: function(response) {
                    $('#product-'+categoryId.replace(/ /g, '_')).empty();

                    let productPromises = response.map(product => {
                        return new Promise((resolve) => {
                            let newPrice = product.harga; // Start with the original price

                            getDiscountCategory(product.category_id).then(discountCategory => {
                                // Check if discountCategory has valid data
                                if (discountCategory && (discountCategory.diskon_persen != null || discountCategory.diskon_harga != null)) {
                                    // Calculate new price based on category discount
                                    if (discountCategory.diskon_persen != null && discountCategory.diskon_persen != 0) {
                                        let discount = product.harga * (discountCategory.diskon_persen / 100);
                                        newPrice -= discount; // Apply percentage discount
                                    }
                                    if (discountCategory.diskon_harga != null && discountCategory.diskon_harga != 0) {
                                        newPrice -= discountCategory.diskon_harga; // Apply flat discount
                                    }
                                }

                                return getDiscountProduct(product.id).then(discountProduct => {
                                    if (discountProduct) {
                                        if (discountProduct.diskon_persen != null && discountProduct.diskon_persen != 0) {
                                            let discount = product.harga * (discountProduct.diskon_persen / 100);
                                            newPrice -= discount; // Apply percentage discount
                                        }
                                        if (discountProduct.diskon_harga != null && discountProduct.diskon_harga != 0) {
                                            newPrice -= discountProduct.diskon_harga; // Apply flat discount
                                        }
                                    } else {
                                        console.warn('Discount product not found for product ID:', product.id);
                                    }

                                    // Resolve the promise with the updated product data
                                    resolve({ product, newPrice });
                                }).catch(() => {
                                    console.warn('Error fetching discount for product ID:', product.id);
                                    resolve({ product, newPrice }); // Resolve with original price in case of error
                                });
                            }).catch(() => {
                                console.warn('Error fetching category discount for category ID:', product.category_id);
                                resolve({ product, newPrice }); // Resolve with original price if there's an error
                            });
                        });
                    });

                    Promise.all(productPromises).then(productsWithPrices => {
                        productsWithPrices.forEach(({ product, newPrice }) => {
                            let routeProductDetail = "{{route('getProductById', ':id')}}".replace(':id', product.uuid);
                            let routeCreateWishlist = "{{route('wishlist.store', ':id')}}".replace(':id', product.uuid);
                            let routeCreateCart = "{{ route('cart.storeCartById', ':id') }}".replace(':id', product.uuid);

                            productHtml += `
                                <li class="col-md-3">
                                    <figure>
                                        <a class="aa-product-img"><img src="${product.image != null ? urlPhoto + product.image : 'img/default/defaultProduct.png'}"  width="250px" height="300px" alt="${product.nama_barang}"></a>`
                            if(product.T_Stocks.stock == 0){
                                productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="errorStock('${product.nama_barang}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                            }else{
                                productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="addToCart('${routeCreateCart}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                            }
                            productHtml +=`<figcaption>
                                            <h4 class="aa-product-title"><a href="#">${product.nama_barang}</a></h4>
                                            ${newPrice < product.harga ? `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span><span class="aa-product-price"><del>Rp ${product.harga.toFixed(2)}</del></span>` : `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span>`}
                                        </figcaption>
                                    </figure>
                                    <div class="aa-product-hvr-content">
                                        <a href="javascript:void(0);" onclick="addToWishlist('${routeCreateWishlist}')" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                        <a href="${routeProductDetail}">Lihat Produk</a>
                                    </div>
                                    <span class="aa-badge aa-sale" href="#">Stok: ${product.T_Stocks.stock}</span>
                                </li>
                            `;
                        });

                        // Append the constructed HTML to the product list
                        $('#product-' + categoryId.replace(/ /g, '_')).append(productHtml);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error jika ada
                    console.error(error);
                }
            });
        }

        $('.aa-products-tab').on('click', 'a', function() {
            $('#browserProduct').removeAttr('href');
            var categoryId = $(this).data('category-id');
            $('#browserProduct').attr('href', "{{ route('product', ':categoryId') }}".replace(':categoryId', categoryId));
            let urlPhoto = "{{$urlPhoto}}";
            var productHtml = '';

            $.ajax({
                url: "{{ route('getEightProductByCategories', ':categoryId') }}".replace(':categoryId', categoryId),
                method: 'GET',
                success: function(response) {
                    // Clear product list before adding new ones
                    $('#product-' + categoryId.replace(/ /g, '_')).empty(); // Move this outside the loop

                    let productPromises = response.map(product => {
                        console.log(product.artikel)
                        return new Promise((resolve) => {
                            let newPrice = product.harga; // Start with the original price

                            getDiscountCategory(product.category_id).then(discountCategory => {
                                // Check if discountCategory has valid data
                                if (discountCategory && (discountCategory.diskon_persen != null || discountCategory.diskon_harga != null)) {
                                    // Calculate new price based on category discount
                                    if (discountCategory.diskon_persen != null && discountCategory.diskon_persen != 0) {
                                        let discount = product.harga * (discountCategory.diskon_persen / 100);
                                        newPrice -= discount; // Apply percentage discount
                                    }
                                    if (discountCategory.diskon_harga != null && discountCategory.diskon_harga != 0) {
                                        newPrice -= discountCategory.diskon_harga; // Apply flat discount
                                    }
                                }

                                return getDiscountProduct(product.id).then(discountProduct => {
                                    // Check if discountProduct is valid
                                    if (discountProduct) {
                                        // Calculate new price based on product discount
                                        if (discountProduct.diskon_persen != null && discountProduct.diskon_persen != 0) {
                                            let discount = product.harga * (discountProduct.diskon_persen / 100);
                                            newPrice -= discount; // Apply percentage discount
                                        }
                                        if (discountProduct.diskon_harga != null && discountProduct.diskon_harga != 0) {
                                            newPrice -= discountProduct.diskon_harga; // Apply flat discount
                                        }
                                    } else {
                                        console.warn('Discount product not found for product ID:', product.id);
                                    }

                                    // Resolve the promise with the updated product data
                                    resolve({ product, newPrice });
                                }).catch(() => {
                                    console.warn('Error fetching discount for product ID:', product.id);
                                    resolve({ product, newPrice }); // Resolve with original price in case of error
                                });
                            }).catch(() => {
                                console.warn('Error fetching category discount for category ID:', product.category_id);
                                resolve({ product, newPrice }); // Resolve with original price if there's an error
                            });
                        });
                    });

                    Promise.all(productPromises).then(productsWithPrices => {
                        productsWithPrices.forEach(({ product, newPrice }) => {
                            let routeProductDetail = "{{route('getProductById', ':id')}}".replace(':id', product.uuid);
                            let routeCreateWishlist = "{{route('wishlist.store', ':id')}}".replace(':id', product.uuid);
                            let routeCreateCart = "{{ route('cart.storeCartById', ':id') }}".replace(':id', product.uuid);

                            productHtml += `
                                <li class="col-md-3">
                                    <figure>
                                        <a class="aa-product-img"><img src="${product.image != null ? urlPhoto + product.image : 'img/default/defaultProduct.png'}"  width="250px" height="300px" alt="${product.nama_barang}"></a>`
                            if(product.T_Stocks.stock == 0){
                                productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="errorStock('${product.nama_barang}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                            }else{
                                productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="addToCart('${routeCreateCart}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                            }
                            productHtml += `<figcaption>
                                            <h4 class="aa-product-title"><a href="#">${product.nama_barang}</a></h4>
                                            ${newPrice < product.harga ? `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span><span class="aa-product-price"><del>Rp ${product.harga.toFixed(2)}</del></span>` : `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span>`}
                                        </figcaption>
                                    </figure>
                                    <div class="aa-product-hvr-content">
                                        <a href="javascript:void(0);" onclick="addToWishlist('${routeCreateWishlist}')" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                        <a href="${routeProductDetail}">Lihat Produk</a>
                                    </div>
                                    <span class="aa-badge aa-sale" href="#">Stok: ${product.T_Stocks.stock}</span>
                                </li>
                            `;
                        });

                        // Append the constructed HTML to the product list
                        $('#product-' + categoryId.replace(/ /g, '_')).append(productHtml);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error jika ada
                    console.error(error);
                }
            });
        });

        // ***** End Of Product Section ***** //


        // ***** Popular Section ***** //
        getDataPopularProduct();
        function getDataPopularProduct(){
            let urlPhoto = "{{$urlPhoto}}"
            var productHtml = '';
            $.ajax({
                url: "{{ route('getProductPopular') }}",
                method: 'GET',
                success: function(response) {
                    $('#list-popular').empty();
                        if(response.length != 0){
                            let productPromises = response.map(product => {
                            console.log(product.artikel)
                            return new Promise((resolve) => {
                                let newPrice = product.harga; // Start with the original price

                                getDiscountCategory(product.category_id).then(discountCategory => {
                                    // Check if discountCategory has valid data
                                    if (discountCategory && (discountCategory.diskon_persen != null || discountCategory.diskon_harga != null)) {
                                        // Calculate new price based on category discount
                                        if (discountCategory.diskon_persen != null && discountCategory.diskon_persen != 0) {
                                            let discount = product.harga * (discountCategory.diskon_persen / 100);
                                            newPrice -= discount; // Apply percentage discount
                                        }
                                        if (discountCategory.diskon_harga != null && discountCategory.diskon_harga != 0) {
                                            newPrice -= discountCategory.diskon_harga; // Apply flat discount
                                        }
                                    }

                                    return getDiscountProduct(product.id).then(discountProduct => {
                                        // Check if discountProduct is valid
                                        if (discountProduct) {
                                            // Calculate new price based on product discount
                                            if (discountProduct.diskon_persen != null && discountProduct.diskon_persen != 0) {
                                                let discount = product.harga * (discountProduct.diskon_persen / 100);
                                                newPrice -= discount; // Apply percentage discount
                                            }
                                            if (discountProduct.diskon_harga != null && discountProduct.diskon_harga != 0) {
                                                newPrice -= discountProduct.diskon_harga; // Apply flat discount
                                            }
                                        } else {
                                            console.warn('Discount product not found for product ID:', product.id);
                                        }

                                        // Resolve the promise with the updated product data
                                        resolve({ product, newPrice });
                                    }).catch(() => {
                                        console.warn('Error fetching discount for product ID:', product.id);
                                        resolve({ product, newPrice }); // Resolve with original price in case of error
                                    });
                                }).catch(() => {
                                    console.warn('Error fetching category discount for category ID:', product.category_id);
                                    resolve({ product, newPrice }); // Resolve with original price if there's an error
                                });
                            });
                        });

                        Promise.all(productPromises).then(productsWithPrices => {
                            productsWithPrices.forEach(({ product, newPrice }) => {
                                let routeProductDetail = "{{route('getProductById', ':id')}}".replace(':id', product.uuid);
                                let routeCreateWishlist = "{{route('wishlist.store', ':id')}}".replace(':id', product.uuid);
                                let routeCreateCart = "{{ route('cart.storeCartById', ':id') }}".replace(':id', product.uuid);

                                productHtml += `
                                    <li class="col-md-3">
                                        <figure>
                                            <a class="aa-product-img"><img src="${product.image != null ? urlPhoto + product.image : 'img/default/defaultProduct.png'}"  width="250px" height="300px" alt="${product.nama_barang}"></a>`
                                if(product.T_Stocks.stock == 0){
                                    productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="errorStock('${product.nama_barang}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                                }else{
                                    productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="addToCart('${routeCreateCart}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                                }
                                productHtml += `<figcaption>
                                                <h4 class="aa-product-title"><a href="#">${product.nama_barang}</a></h4>
                                                ${newPrice < product.harga ? `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span><span class="aa-product-price"><del>Rp ${product.harga.toFixed(2)}</del></span>` : `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span>`}
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                            <a href="javascript:void(0);" onclick="addToWishlist('${routeCreateWishlist}')" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                            <a href="${routeProductDetail}">Lihat Produk</a>
                                        </div>
                                        <span class="aa-badge aa-sale" href="#">Stok: ${product.T_Stocks.stock}</span>
                                    </li>
                                `;
                            });

                            // Append the constructed HTML to the product list
                            $('#list-popular').append(productHtml);
                        });
                    }else{
                        productHtml = `<li>
                                        <figure>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="#">Tidak Ada Produk</a></h4>
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                        <div/>
                                    </li>`
                        $('#list-popular').append(productHtml);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error jika ada
                    console.error(error);
                }
            });
        }

        $('.aa-popular-tab').on('click', 'a', function(){
            let data = $(this).data('list');
            let urlPhoto = "{{$urlPhoto}}"
            let urlData;
            var productHtml = '';
            if(data == 'popular'){
                urlData = "{{ route('getProductPopular') }}"
            }else if(data == 'featured'){
                urlData = "{{ route('getProductFeatured') }}"
            }else{
                urlData = "{{ route('getProductLatest') }}"
            }
            $.ajax({
                url: urlData,
                method: 'GET',
                success: function(response) {
                    $('#list-'+data).empty();
                    if(response.length != 0){
                        let productPromises = response.map(product => {
                            return new Promise((resolve) => {
                                let newPrice = product.harga; // Start with the original price

                                getDiscountCategory(product.category_id).then(discountCategory => {
                                    // Check if discountCategory has valid data
                                    if (discountCategory && (discountCategory.diskon_persen != null || discountCategory.diskon_harga != null)) {
                                        // Calculate new price based on category discount
                                        if (discountCategory.diskon_persen != null && discountCategory.diskon_persen != 0) {
                                            let discount = product.harga * (discountCategory.diskon_persen / 100);
                                            newPrice -= discount; // Apply percentage discount
                                        }
                                        if (discountCategory.diskon_harga != null && discountCategory.diskon_harga != 0) {
                                            newPrice -= discountCategory.diskon_harga; // Apply flat discount
                                        }
                                    }

                                    return getDiscountProduct(product.id).then(discountProduct => {
                                        if (discountProduct) {
                                            if (discountProduct.diskon_persen != null && discountProduct.diskon_persen != 0) {
                                                let discount = product.harga * (discountProduct.diskon_persen / 100);
                                                newPrice -= discount; // Apply percentage discount
                                            }
                                            if (discountProduct.diskon_harga != null && discountProduct.diskon_harga != 0) {
                                                newPrice -= discountProduct.diskon_harga; // Apply flat discount
                                            }
                                        } else {
                                            console.warn('Discount product not found for product ID:', product.id);
                                        }

                                        // Resolve the promise with the updated product data
                                        resolve({ product, newPrice });
                                    }).catch(() => {
                                        console.warn('Error fetching discount for product ID:', product.id);
                                        resolve({ product, newPrice }); // Resolve with original price in case of error
                                    });
                                }).catch(() => {
                                    console.warn('Error fetching category discount for category ID:', product.category_id);
                                    resolve({ product, newPrice }); // Resolve with original price if there's an error
                                });
                            });
                        });

                        Promise.all(productPromises).then(productsWithPrices => {
                            productsWithPrices.forEach(({ product, newPrice }) => {
                                let routeProductDetail = "{{route('getProductById', ':id')}}".replace(':id', product.uuid);
                                let routeCreateWishlist = "{{route('wishlist.store', ':id')}}".replace(':id', product.uuid);
                                let routeCreateCart = "{{ route('cart.storeCartById', ':id') }}".replace(':id', product.uuid);

                                productHtml += `
                                    <li class="col-md-3">
                                        <figure>
                                            <a class="aa-product-img"><img src="${product.image != null ? urlPhoto + product.image : 'img/default/defaultProduct.png'}"  width="250px" height="300px" alt="${product.nama_barang}"></a>`
                                if(product.T_Stocks.stock == 0){
                                    productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="errorStock('${product.nama_barang}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                                }else{
                                    productHtml += `<a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="addToCart('${routeCreateCart}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>`;
                                }
                                productHtml += `<figcaption>
                                                <h4 class="aa-product-title"><a href="#">${product.nama_barang}</a></h4>
                                                ${newPrice < product.harga ? `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span><span class="aa-product-price"><del>Rp ${product.harga.toFixed(2)}</del></span>` : `<span class="aa-product-price">Rp ${newPrice.toFixed(2)} </span>`}
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                            <a href="javascript:void(0);" onclick="addToWishlist('${routeCreateWishlist}')" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                            <a href="${routeProductDetail}">Lihat Produk</a>
                                        </div>
                                        <span class="aa-badge aa-sale" href="#">Stok: ${product.T_Stocks.stock}</span>
                                    </li>
                                `;
                            });

                            // Append the constructed HTML to the product list
                            $('#list-'+data).append(productHtml);
                        });
                    }else{
                        productHtml = `<li>
                                        <figure>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="#">Tidak Ada Produk</a></h4>
                                            </figcaption>
                                        </figure>
                                    <div class="aa-product-hvr-content">
                                    <div/>
                                    </li>`
                        $('#list-'+data).append(productHtml);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error jika ada
                    console.error(error);
                }
            });
        });
        // ***** End of Popular Section ***** //
    })
</script>
@stop
