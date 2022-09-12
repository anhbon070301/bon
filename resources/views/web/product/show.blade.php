@include('header')
<html>

<body>
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @if (isset(Auth::user()->id))
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active"><a href="{{ route('shop') }}">Shop page</a></li>
                        @else
                        <li class=""><a href="/phone/public/">Home</a></li>
                        <li class="active"><a href="{{ route('shop') }}">Shop page</a></li>
                        @endif

                        @if(isset(Auth::user()->id))
                        <li><a href="{{ route('showCart', Auth::user()->id) }}">Cart</a></li>
                        @endif
                        
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="{{ route('showProduct', $product->id) }}">
                            @csrf
                            <input type="text" name="search" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        @foreach($products as $products)
                        <div class="thubmnail-recent">
                            <img src="/phone/public/images/{{ $products->image }}" class="recent-thumb" alt="">
                            <h2><a href="{{ route('showProduct', $products->id) }}">{{ $products->name }}</a></h2>
                            <div class="product-sidebar-price">
                                <ins>${{ number_format($products->price) }}</ins> <del>${{ number_format($products->old_price) }}</del>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  
                </div>
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="/phone/public/images/{{$product->image}}" alt="">
                                    </div>

                                    <div class="product-gallery">
                                        @foreach ($productImg as $productImgList)
                                        <img src="/phone/public/images/{{ $productImgList->image_url }}" alt="">
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{ $product->name }}</h2>
                                    <div class="product-inner-price">
                                        <ins>${{ number_format($product->price) }}</ins> <del>${{ number_format($product->old_price) }}</del>
                                    </div>
                                    @if (isset(Auth::user()->id))
                                    <form action="{{ route('storeCart') }}" method="post" class="cart">
                                        @csrf
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $product->name }}" name="product_name">
                                        <input type="hidden" value="{{ $product->image }}" name="product_image">
                                        <input type="hidden" value="{{ $product->price }}" name="product_price">
                                        <input type="submit" class="add_to_cart_button" value="ADD">
                                    </form>
                                    @endif

                                    <div class="product-inner-category">
                                        <p> Tags: <a href="{{ route('showbyTag', $product->tags) }}">{{ $product->tags }}</a> </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            @if (isset(Auth::user()->id))
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                <form action="{{ route('storeComment') }}" method="post" class="cart">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="user_name" value="{{ Auth::user()->username }}">
                                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                    <p><label for="name">Name</label> <input name="name" value="{{ Auth::user()->username }}" disabled type="text"></p>
                                                    <p><label for="review">Your review</label> <textarea name="comments" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="related-products-wrapper">
                                <h2 class="related-products-title">Related Products</h2>
                                <div class="related-products-carousel">
                                    @foreach($productTag as $productTagList)
                                    <form action="{{ route('storeCart') }}" method="post">
                                    @csrf
                                        <div class="single-product">
                                            <div class="product-f-image">
                                                <img src="/phone/public/images/{{ $productTagList->image }}" alt="">
                                                <div class="product-hover">

                                                    <a href="{{ route('showProduct', $productTagList->id) }}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                                </div>
                                            </div>
                                            <h2><a href="">{{ $productTagList->name }}</a></h2>
                                            <div class="product-carousel-price">
                                                <ins>${{ number_format($productTagList->price) }}</ins> <del>${{ number_format($productTagList->old_price) }}</del>
                                            </div>
                                            <div class="product-option-shop">
                                                <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                            </div>
                                        </div>
                                        @if (isset(Auth::user()->id))
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="hidden" value="{{ $productTagList->id }}" name="product_id">
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $productTagList->name }}" name="product_name">
                                        <input type="hidden" value="{{ $productTagList->image }}" name="product_image">
                                        <input type="hidden" value="{{ $productTagList->price }}" name="product_price">
                                        @endif
                                    </form>
                                    @endforeach
                                </div>
                            </div>

                            <div class="related-products-wrapper">
                                <h2 class="related-products-title">Comment</h2>
                                @foreach ($comments as $comment)
                                    @if (isset(Auth::user()->id))
                                        @if ($comment->user_id == Auth::user()->id)
                                            <form action="{{ route('updateComment') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $comment->id }}" name="id">
                                                <input type="hidden" value="{{ $comment->product_id }}" name="product_id">
                                                <p><span style="color: red;">{{ $comment->user_name }}: </span> <input style="border: 2px hidden #b1154a;" type="text" name="comment" value="{{ $comment->comments }}"> <button style=" border: none; background-color: #f4f4f4">Sửa</button> </p>
                                            </form>
                                        @else
                                            <p><span style="color: blue;">{{ $comment->user_name }}: </span> {{ $comment->comments }} </p>
                                        @endif
                                    @else
                                            <p><span>{{ $comment->user_name }}: </span> {{ $comment->comments }} </p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Order history</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Vendor contact</a></li>
                            <li><a href="#">Front page</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="#">Mobile Phone</a></li>
                            <li><a href="#">Home accesseries</a></li>
                            <li><a href="#">LED TV</a></li>
                            <li><a href="#">Computer</a></li>
                            <li><a href="#">Gadets</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- End footer top area -->

    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->

    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="/phone/resources/js/js/owl.carousel.min.js"></script>
    <script src="/phone/resources/js/js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="/phone/resources/js/js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="/phone/resources/js/js/main.js"></script>

    <!-- Slider -->
    <script type="text/javascript" src="/phone/resources/js/js/bxslider.min.js"></script>
    <script type="text/javascript" src="/phone/resources/js/js/script.slider.js"></script>
</body>

</html>