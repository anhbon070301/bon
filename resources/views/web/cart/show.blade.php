@include('header')

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
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop page</a></li>
                    <li class="active"><a href="{{ route('showCart', Auth::user()->id) }}">Cart</a></li>
                    
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
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="{{ route('showCart', Auth::user()->id) }}">
                        <input type="text" name="search" placeholder="Search products...">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Products</h2>
                    @foreach( $products as $productSearch )
                    <div class="thubmnail-recent">
                        <img src="/phone/public/images/{{ $productSearch->image }}" class="recent-thumb" alt="">
                        <h2><a href="{{ route('showProduct', $productSearch->id) }}">{{ $productSearch->name }}</a></h2>
                        <div class="product-sidebar-price">
                            <ins>${{ number_format($productSearch->price) }}</ins> <del>${{ number_format($productSearch->old_price) }}</del>
                        </div>
                    </div>
                    @endforeach
                </div>               
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" action="{{ route('updateCart', Auth::user()->id) }}">
                            @csrf
                            <table style="width:100%" cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th style="width:5%" class="product-remove">&nbsp;</th>
                                        <th style="width:15%" class="product-thumbnail">&nbsp;</th>
                                        <th style="width:30%" class="product-name">Product</th>
                                        <th style="width:10%" class="product-price">Price</th>
                                        <th style="width:30%" class="product-quantity">Quantity</th>
                                        <th style="width:10%" class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ( $carts as $cartList )
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <a title="Remove this item" class="remove" href="{{ route('destroyCart', $cartList->id) }}">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="{{ route('showProduct', $cartList->product_id) }}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="/phone/public/images/{{ $cartList->product_image }}"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="{{ route('showProduct', $cartList->product_id) }}">{{ $cartList->product_name }}</a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">${{ number_format($cartList->product_price) }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <ul>
                                                    <a href="{{ route('tru', $cartList->id) }}" class="btn btn-primary minus">-</a>
                                                    <input type="number" size="3" class="input-text qty text" title="Qty" name="quantity[{{ $cartList->id }}]" value="{{ $cartList->quantity }}" min="0" step="1">
                                                    <a href="{{ route('cong',  $cartList->id) }}" class="btn btn-primary plus">+</a>
                                                </ul>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{ number_format($cartList->product_price * $cartList->quantity ) }} </span>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="idc[{{ $cartList->id }}]" value="{{ $cartList->id }}">
                                    @endforeach
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                            </div>
                                            <input type="submit" value="Update Cart" name="update_cart" class="button">
                                            <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">
                            <div class="cross-sells">
                                <h2>You may be interested in...</h2>
                                <ul class="products">
                                @foreach( $productBestSell as $productBestSellData )
                                    <li class="product">
                                        <a href="{{  route('showProduct', $productBestSellData->id) }}">
                                            <img style="height: 100px;" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="/phone/public/images/{{ $productBestSellData->image }}">
                                            <h3 style="height: 60px;">{{ $productBestSellData->name }}</h3>
                                            <span class="price"><span class="amount">${{ number_format($productBestSellData->price) }}</span></span>
                                        </a>
                                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="{{ route('showProduct', $productBestSellData->id) }}">Select options</a>
                                    </li>
                                @endforeach                                
                                </ul>
                            </div>

                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>
                                <table cellspacing="0">
                                    <tbody>

                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">${{ number_format($totalMoney) }}</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">${{ number_format($totalMoney)}}</span></strong> </td>
                                        </tr>

                                    </tbody>
                                </table>
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