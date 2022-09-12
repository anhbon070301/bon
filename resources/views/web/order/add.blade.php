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
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('shop')}}">Shop page</a></li>
                    <li><a href="{{route('showCart',Auth::user()->id)}}">Cart</a></li>
                    
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
                    <form action="{{route('updateCart',Auth::user()->id)}}" method="post">
                        @csrf
                        <input type="text" name="search" placeholder="Search products...">
                        @foreach ($cart as $c)
                            <input type="hidden" name="idc[{{$c->id}}]" value="{{$c->id}}">
                        @endforeach
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Products</h2>
                    @foreach($products as $p)
                    <div class="thubmnail-recent">
                        <img src="/phone/public/images/{{$p->image}}" class="recent-thumb" alt="">
                        <h2><a href="{{route('showProduct',$p->id)}}">{{$p->name}}</a></h2>
                        <div class="product-sidebar-price">
                            <ins>${{number_format($p->price)}}</ins> <del>${{number_format($p->old_price)}}</del>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form name="frmAddCart" method="post" action="{{route('storeOrder')}}">
                            @csrf
                            <div class="col-3">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>

                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cart as $c)
                                        <tr class="cart_item">


                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="/phone/public/images/{{$c->product_image}}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html">{{$c->product_name}}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">${{number_format($c->product_price)}}</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <ul>

                                                        <input type="text" disabled size="3" class="input-text qty text" title="Qty" name="" value="{{$c->quantity}}" min="0" step="1">
                                                        <input type="hidden" size="3" class="input-text qty text" title="Qty" name="quantity" value="{{$c->quantity}}" min="0" step="1">
                                                    </ul>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{number_format($c->product_price * $c->quantity )}} </span>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="idc[{{$c->id}}]" value="{{$c->id}}">
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <div class="col-5">
                                <div class="woocommerce-billing-fields">
                                    <h3>Billing Details</h3>
                                    
                                    <input type="hidden" value="{{Auth::user()->id}}" placeholder="" id="user_id" name="user_id" class="input-text ">
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Name <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="billing_first_name" required name="customer_name" class="input-text ">
                                    </p>

                                    <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                        <label class="" for="billing_last_name">Phone <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="billing_last_name" required name="customer_phone" class="input-text ">
                                    </p>
                                    <div class="clear"></div>

                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="billing_company">Email</label>
                                        <input type="text" value="{{Auth::user()->email}}" placeholder="" id="billing_company" name="customer_email" class="input-text ">
                                    </p>

                                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                        <label class="" for="billing_address_1">Total
                                        </label>
                                        <input type="text" value="{{$totalMoney}}" placeholder="" id="billing_address_1" name="total_money" class="input-text ">
                                    </p>
                                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                        <label class="" for="billing_address_1">Total Product
                                        </label>
                                        <input type="text" value="{{$quantity}}" placeholder="" id="billing_address_1" name="total_products" class="input-text ">
                                    </p>
                                    <h3>Address</h3>
                                    
                                    <input type="hidden" value="{{Auth::user()->id}}" placeholder="" id="user_id" name="user_id" class="input-text ">
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Tỉnh <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <select name="provinces" id="provinces" class="country_to_state country_select choose provinces">
                                        <option value="" >---Chọn Tỉnh---</option>
                                            @foreach ($provinces as $prv)
                                            <option value="{{$prv->id}}">{{$prv->name}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required ">
                                        <label class="" for="billing_first_name">Huyện <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <select name="districts" id="districts" class="country_to_state country_select choose districts">
                                            
                                            <option value="">---Chọn Huyện---</option>
                                           
                                        </select>
                                    </p>
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Xã <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <select name="wards" id="wards" class="country_to_state country_select wards">
                                            
                                            <option value="">---Chọn Xã---</option>
                                           
                                        </select>
                                    </p>
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Địa chỉ <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text"  placeholder="" id="billing_address_1" name="address" required class="input-text ">
                                    </p>
                                </div>
                            </div>
                          
                            <div class="form-row place-order col-8">

                                <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                
                            </div>



                        </form>
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
<script type="text/javascript">
    $(document).ready(function () {
	$('.choose').on('change',function(){
        var action = $(this).attr('id');
        var id = $(this).val();
        var _token = $('input[name="_token"]').val();
       var result = "";
       if(action == 'provinces'){
        result = 'districts';
       }else{
        result = 'wards';
       }
       $.ajax({
        url : "{{route('select-delivery')}}",
        method : 'POST',
        data : {action:action,id:id,_token:_token},
        success: function (data) {
                       $('#'+result).html(data);
                    },
       });
    })
});
</script>
