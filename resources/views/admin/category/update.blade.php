@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>UPDATE CATEGORY</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateCate', $category->id) }}" method="post" id="edit-profile"
                                class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label" for="firstname">Category Name @if ( $errors -> has('name') ) <span>*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" name="name" value="{!! old('name') !!}" type="text" />
                                            @else 
                                                <input type="text" class="span3" name="name" value="{{ $category->name }}">
                                            @endif 
                                         </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label" for="lastname">Order Sort @if ( $errors -> has('sort_order') ) <span>*</span>@else <span>*</span> @endif</label>
                                        <div class="controls">
                                            @if ( $errors -> any() )
                                                <input class="span3" name="sort_order" value="{!! old('sort_order') !!}" type="text" />
                                            @else 
                                                <input type="text" class="span3" id="lastname" name="sort_order" value="{{ $category->sort_order }}">
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
    </div>
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