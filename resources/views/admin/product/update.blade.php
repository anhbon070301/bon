@include ('admin.index')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        
                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>UPDATE PRODUCT</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateProducts', $products->id) }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Category <span>*</span></label>
                                        <div class="controls">
                                            <select class="span3" name="category" id="cars">
                                                @foreach ($categories as $categoryList)
                                                    @if ($categoryList->id == $category->id)
                                                        <option value="{{ $categoryList->id }}" selected>{{ $categoryList->name }}</option>
                                                    @else
                                                        <option value="{{ $categoryList->id }}">{{ $categoryList->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Brand <span>*</span></label>
                                        <div class="controls">
                                            <select class="span3" name="brand" id="cars">
                                                @foreach ($brands as $brandList)
                                                    @if ($brandList->id == $brand->id)
                                                        <option value="{{ $brandList->id }}" selected>{{ $brandList->name }}</option>
                                                    @else
                                                        <option value="{{ $brandList->id }}">{{ $brandList->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Product Name @if ( $errors ->has('name') ) <span style="color: red;">*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="name" id="firstname" value="{{ $products->name }}" disabled>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Price @if ( $errors ->has('price') ) <span style="color: red;">*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" id="hinhanh" name="price"  value="{!! old('price') !!}"  type="text" />
                                            @else 
                                                <input class="span3" id="hinhanh" name="price" value="{{ $products->price }}"  type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Price Old</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" id="hinhanh" name="old_price" value="{!! old('old_price') !!}" type="text" />
                                            @else 
                                                <input class="span3" id="hinhanh" name="old_price" value="{{ $products->old_price }}"  type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Tags</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" id="hinhanh" name="tags" value="{!! old('tags') !!}" type="text" />
                                            @else 
                                                <input class="span3" id="hinhanh" name="tags" value="{{ $products->tags }}" type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Best Sell</label>
                                        <div class="controls">
                                            <select class="span3" name="is_best_sell" id="">
                                                @if ( $products->is_best_sell == 0 )
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                @else
                                                    <option value="0">0</option>
                                                    <option value="1" selected>1</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">New</label>
                                        <div class="controls">
                                            <select class="span3" name="is_new" id="">
                                                @if ( $products->is_new == 0 )
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                @else
                                                    <option value="0">0</option>
                                                    <option value="1" selected>1</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="lastname">Order Sort</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" id="hinhanh" name="sort_order" value="{!! old('sort_order') !!}" type="text" />
                                            @else 
                                                <input type="text" class="span3"  name="sort_order" value="{{ $products->sort_order }}">
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Image</label>
                                        <div class="controls">
                                            <input type="hidden" name="image_old" value="{{ $products->image }}">
                                            <input value="" class="" id="hinhanh" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <img width="60px" height="60px" src="../images/{{ $products->image }}" alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Description @if( $errors ->has('description') ) <span style="color: red;">*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <textarea name="description" style="height: 150px;" class="span10 first">{!! old('description') !!}</textarea>
                                            @else 
                                                <textarea name="description" style="height: 150px;" class="span10 first">{{ $products->description }}</textarea>
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    @if ( $errors -> any() )
                                    <div class="alert alert-primary text-center">
                                        @foreach ( $errors->all() as $errors )
                                        <p>{{ $errors }}</p>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button class="btn" type="clear">Clear</button>
                                    </div> <!-- /form-actions -->

                                </fieldset>
                            </form>
                        </div> <!-- /widget-content -->
                    
                    </div> <!-- /widget -->
                </div> <!-- /span8 -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div>  <!-- than -->
</div>
<div class="extra">
    <div class="extra-inner">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <h4>
                        About Free Admin Template</h4>
                    <ul>
                        <li><a href="javascript:;">EGrappler.com</a></li>
                        <li><a href="javascript:;">Web Development Resources</a></li>
                        <li><a href="javascript:;">Responsive HTML5 Portfolio Templates</a></li>
                        <li><a href="javascript:;">Free Resources and Scripts</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Support</h4>
                    <ul>
                        <li><a href="javascript:;">Frequently Asked Questions</a></li>
                        <li><a href="javascript:;">Ask a Question</a></li>
                        <li><a href="javascript:;">Video Tutorial</a></li>
                        <li><a href="javascript:;">Feedback</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Something Legal</h4>
                    <ul>
                        <li><a href="javascript:;">Read License</a></li>
                        <li><a href="javascript:;">Terms of Use</a></li>
                        <li><a href="javascript:;">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Open Source jQuery Plugins</h4>
                    <ul>
                        <li><a href="">Open Source jQuery Plugins</a></li>
                        <li><a href="">HTML5 Responsive Tempaltes</a></li>
                        <li><a href="">Free Contact Form Plugin</a></li>
                        <li><a href="">Flat UI PSD</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
                <!-- /span12 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /footer-inner -->
</div>
<!-- /footer -->