@include ('admin.index')

<style>
input.first {
    min-height: 100px;
}
</style>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>ADD PRODUCT</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeProduct') }}" method="post" id="edit-profile"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Category <span>*</span></label>
                                        <div class="controls">
                                            <select class="span3" name="category" id="cars">
                                                <option value="">------</option>
                                                @foreach ( $categories as $category )
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Brand <span>*</span></label>
                                        <div class="controls">
                                            <select class="span3" name="brand" id="cars">
                                                <option value="">-----</option>
                                                @foreach ( $brands as $brand )
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Product Name  @if ( $errors ->has('name') ) <span>*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="name" id="firstname" value="{!! old('name') !!}">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Price  @if ( $errors ->has('price') ) <span>*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            <input class="span3" id="hinhanh" name="price" type="text" value="{!! old('price') !!}"/>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Price Old</label>
                                        <div class="controls">
                                            <input class="span3" id="hinhanh" name="old_price" type="text" value="{!! old('old_price') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Tags</label>
                                        <div class="controls">
                                            <input class="span3" id="hinhanh" name="tags" type="text" value="{!! old('tags') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Best Sell</label>
                                        <div class="controls">
                                            <select class="span3" name="is_best_sell" id="">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">New</label>
                                        <div class="controls">
                                            <select class="span3" name="is_new" id="">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                            </select>

                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="lastname">Order Sort</label>
                                        <div class="controls">
                                            <input type="text" class="span3" id="lastname" name="sort_order" value="{!! old('sort_order') !!}">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Image</label>
                                        <div class="controls">
                                            <input class="span2" id="hinhanh" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Description  @if ( $errors ->has('description') ) <span>*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            <textarea name="description" style="height: 150px;" class="span10 first">{!! old('description') !!}</textarea>
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
                                        <button class="btn">Cancel</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div> <!-- /widget-content -->

                    </div> <!-- /widget -->
                </div> <!-- /span8 -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div>
</div>
<!-- het main -->
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