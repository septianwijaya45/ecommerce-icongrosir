@extends('layouts.app')


@section('content')
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
         <h2>Katalog Kami</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('home') }}">Home</a></li>
           <li class="active">Katalog Kami</li>
         </ol>
       </div>
      </div>
    </div>
</section>


<section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
            <div class="aa-product-catg-content">
                <div class="aa-product-catg-head">
                    <div class="row">
                        <div class="col-md-10">
                            <form class="aa-sort-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Urutkan Berdasarkan</label>
                                        <select name="sort_by" class="form-control" id="sort_by">
                                            <option value="all" selected>All</option>
                                            <option value="nama_asc">Nama (A-Z)</option>
                                            <option value="nama_desc">Nama (Z-A)</option>
                                            <option value="harga_asc">Harga Terendah</option>
                                            <option value="harga_desc">Harga Tertinggi</option>
                                            <option value="tanggal_asc">Terbaru</option>
                                            <option value="tanggal_desc">Terlama Unggulan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Cari Produk</label>
                                        <input type="text" name="search-product" id="search-product" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                            <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                        </div>
                    </div>
                </div>
                <div class="aa-product-catg-body">
                    <ul class="aa-product-catg">
                        <div class="row list-product">
                        </div>
                    </ul>
                </div>
                <div class="aa-product-catg-pagination">
                <nav>
                    <ul class="pagination">
                    </ul>
                </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                @forelse($categories as $category)
                  <li><a href="#" class="category-link" data-category-id="{{ $category['id'] }}">{{ $category['category'] }}</a></li>
                @empty
                  <li>Tidak Ada Category</li>
                @endforelse
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul class="top-view">

                </ul>
              </div>
            </div>
            <!-- single sidebar -->
{{--
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div> --}}
          </aside>
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
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.querySelector('.list-product');
    const productView = document.querySelector('.top-view')
    const paginationContainer = document.querySelector('.pagination');
    const sortByElement = document.getElementById('sort_by');
    const searchElement = document.getElementById('search-product');

    let currentPage = 1;
    const limit = 8;

    sortByElement.addEventListener('change', function() {
        fetchProducts(currentPage);
    });

    // Event listener for search input
    searchElement.addEventListener('input', function() {
        fetchProducts(currentPage);
    });

    function fetchProducts(page) {
        const sortBy = sortByElement.value;
        const search = searchElement.value;

        fetch(`{{$apiUrl}}/home/product/get-all-product?page=${page}&limit=${limit}&sort_by=${sortBy}&search=${search}`)
            .then(response => response.json())
            .then(data => {
                renderProducts(data.data);
                renderPagination(data.pagination);
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    function fetchProductsTopView() {
        fetch(`{{$apiUrl}}/home/product/get-top-view-product`)
            .then(response => response.json())
            .then(data => {
                renderProductViews(data.data);
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    let urlPhoto = '{{ $photoUrl }}'
    const baseUrl = `${window.location.protocol}//${window.location.host}`;

    function renderProducts(products) {
        productContainer.innerHTML = '';
        products.forEach(product => {
            let routeProductDetail = "{{ route('getProductById', ':id') }}".replace(':id', product.uuid);
            let routeCreateWishlist = "{{ route('wishlist.store', ':id') }}".replace(':id', product.uuid);
            let routeCreateCart = "{{ route('cart.storeCartById', ':id') }}".replace(':id', product.uuid);
            const productHTML = `
                <li class="col-md-4">
                    <figure>
                        <a class="aa-product-img">
                            <img src="${(product.image != null) ? urlPhoto + product.image : baseUrl + '/img/default/defaultProduct.png'}" alt="product image" width="250px" height="300px">
                        </a>
                        <a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @else href="javascript:void(0);" onclick="addToCart('${routeCreateCart}')" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                            <h4 class="aa-product-title"><a href="#">${product.nama_barang}</a></h4>
                            <span class="aa-product-price">Rp ${product.harga != null ? product.harga : 0}</span>
                            <p class="aa-product-descrip">${(product.deskripsi != null) ? product.deskripsi : 'Tidak Ada Deskripsi'}</p>
                        </figcaption>
                    </figure>
                    <div class="aa-product-hvr-content">
                        <a href="javascript:void(0);" onclick="addToWishlist('${routeCreateWishlist}')" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="${routeProductDetail}">Lihat Produk</a>
                    </div>
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
            `;
            productContainer.insertAdjacentHTML('beforeend', productHTML);
        });
    }

    function renderProductViews(products) {
        productView.innerHTML = '';
        products.forEach(product => {
            let routeProductDetail = "{{route('getProductById', ':id')}}".replace(':id', product.uuid);
            const productHTML = `
                <li>
                    <a href="${routeProductDetail}" class="aa-cartbox-img"><img alt="img" src="${(product.image != null) ? urlPhoto+product.image : baseUrl+'/img/default/defaultProduct.png'}"></a>
                    <div class="aa-cartbox-info">
                        <h4><a href="#">${product.nama_barang}</a></h4>
                        <p>Rp ${product.harga}</p>
                    </div>
                    </li>
            `;
            productView.insertAdjacentHTML('beforeend', productHTML);
        });
    }

    function renderPagination(pagination) {
        paginationContainer.innerHTML = '';

        if (pagination.currentPage > 1) {
        paginationContainer.innerHTML += `<li><a href="#" aria-label="Previous" data-page="${pagination.currentPage - 1}"><span aria-hidden="true">&laquo;</span></a></li>`;
        }

        for (let i = 1; i <= pagination.totalPages; i++) {
        paginationContainer.innerHTML += `<li><a href="#" data-page="${i}">${i}</a></li>`;
        }

        if (pagination.currentPage < pagination.totalPages) {
        paginationContainer.innerHTML += `<li><a href="#" aria-label="Next" data-page="${pagination.currentPage + 1}"><span aria-hidden="true">&raquo;</span></a></li>`;
        }

        paginationContainer.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', function(event) {
            event.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            fetchProducts(page);
        });
        });
    }

    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const categoryId = this.getAttribute('data-category-id');
            fetchProductsByCategory(categoryId, 1);  // Fetch products for the selected category, starting with page 1
        });
    });

    function fetchProductsByCategory(categoryId, page) {
        fetch(`{{$apiUrl}}/home/product/get-all-product?category=${categoryId}&page=${page}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                renderProducts(data.data);
                renderPagination(data.pagination);
            })
            .catch(error => console.error('Error fetching products by category:', error));
    }

    // Initial fetch
    fetchProducts(currentPage);
    fetchProductsTopView()
});
</script>
@stop
