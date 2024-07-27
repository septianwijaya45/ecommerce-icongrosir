@extends('layouts.app')

@section('content') 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{ asset('img/products/detail-product.jpg') }}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>{{ $product['nama_barang'] }}</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
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
                          <div class="simpleLens-big-image-container"><a data-lens-image="{{ $photoUrl.$photo[0]['nama_file'] }}" class="simpleLens-lens-image"><img src="{{ $photoUrl.$photo[0]['nama_file'] }}" class="simpleLens-big-image"></a></div>
                        @else
                          <div class="simpleLens-big-image-container"><a data-lens-image="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-lens-image"><img src="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-big-image"></a></div>
                        @endif
                      </div>
                      <div class="simpleLens-thumbnails-container">
                        @if(count($photo) != 0)
                          @foreach($photo as $foto)
                            <a data-big-image="{{ $photoUrl.$foto->nama_file }}" data-lens-image="{{ $photoUrl.$foto->nama_file }}" class="simpleLens-thumbnail-wrapper" href="#">
                              <img src="{{ $photoUrl.$foto->nama_file }}" width="50px">
                            </a>
                          @endforeach
                        @else
                          <br>
                          <a data-big-image="{{ asset('img/products/image-not-found.jpg') }}" data-lens-image="{{ asset('img/products/image-not-found.jpg') }}" class="simpleLens-thumbnail-wrapper" href="#">
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
                      <span class="aa-product-view-price">Rp {{ $product['harga'] }}</span>
                      <p class="aa-product-avilability">Stok:  @if($productDetail[0]['t_stok_details']['stock'] != 0) <span class="text-success">Tersedia</span>@else <span class="text-danger">Tidak Ada</span>  @endif</p>
                    </div>
                    <p>{{ $product['deskripsi'] }}</p>
                    <h4>Ukuran</h4>
                    <div class="aa-prod-view-size">
                        @foreach($productSize as $size)
                          <select id="warna" class="aa-prod-view-size"  name="warna">
                            <option value="" selected>Silahkan Pilih Ukuran</option>
                            <option value="0">{{$size['ukuran']}}</option>
                          </select>
                        @endforeach
                    </div>
                    <h4>Warna</h4>
                    <div class="aa-color-tag">
                        @foreach($productDetail as $color)
                          <select id="warna" class="aa-prod-view-size"  name="warna">
                            <option value="" selected>Silahkan Pilih Warna</option>
                            <option value="0">{{$color['warna']}}</option>
                          </select>
                        @endforeach                      
                    </div>
                    <div class="aa-prod-quantity">
                      <input type="text" id="qty" placeholder="QTY Pesanan">
                      <p class="aa-prod-category">
                        Category:  <a href="#">{{ $category['category'] }}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" id="cart" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif> Add To Cart</a>
                      <a class="aa-add-to-cart-btn" id="wishlist" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif>Wishlist</a>
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
                    @if(!is_null($product['deskripsi_detail'])) 
                      $product['deskripsi_detail'] 
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
                        <a class="aa-product-img" href="#"><img src="{{ $product['photos'] && count($product['photos']) > 0 ? $photoUrl+$photos[0].nama_file : asset('img/products/image-not-found.jpg') }}"  width="250px" alt="{{$product['nama_barang']}}"></a>
                        <a class="aa-add-card-btn" @if($token == null) data-toggle="modal" data-target="#login-modal" @endif><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                            <h4 class="aa-product-title"><a href="#">{{$product['nama_barang']}}</a></h4>
                            <span class="aa-product-price">Rp {{ $product['harga'] != null ? $product['harga'] : 0 }}</span>
                            @if($product['diskon_tipe'] != null)
                              <span class="aa-product-price"><del> {{ $product['diskon_tipe'] }} </del></span>
                            @else
                            @endif
                        </figcaption>
                    </figure>                        
                    <div class="aa-product-hvr-content">
                        <a @if($token == null) data-toggle="modal" data-target="#login-modal" @endif data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="`+routeProductDetail+`" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-eye"></span></a>                          
                    </div>
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                  </li>
                @endforeach                                                                             
              </ul>
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->

  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Our Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> 25 Astor Pl, NY 10003, USA</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
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
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
@stop