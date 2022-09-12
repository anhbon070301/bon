@include ('admin.index')
<link rel="stylesheet" href="/phone/resources/css/css/owl.carousel.css">
<link rel="stylesheet" href="/phone/resources/css/style.css">
<link rel="stylesheet" href="/phone/resources/css/css/responsive.css">
<link rel="stylesheet" href="/phone/resources/css/css/bootstrap.min.css">
<div class="main">
    <div class="col-md-10">
        <div class="product-content-right">
            <div class="row">

                <div class="col-sm-6">
                    <div class="product-images">
                        <div class="product-main-img">
                            <img src="../images/{{ $product->image }}" width="400px" height="600px" alt="k tải được">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="product-inner">
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div role="tabpanel">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <h2>Product Description</h2>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="product-images">
                        <a href="{{ route('createImage', $product->id) }}" class="btn btn-primary"> <i class="icon-plus"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hết  -->
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20%"> Number </th>
                                    <th style="width:30%"> Image </th>
                                    <th style="width:20%"> Order Sort </th>
                                    <th style="width:30%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($images as $key => $imageList)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="../images/{{ $imageList->image_url }}" height="50px" width="200px" alt="Khong tai duoc"></td>
                                    <td>{{ $imageList->sort_order }}</td>
                                    <td>
                                        <form method="post" action="">
                                            <input value="{{ $imageList->id }}" type="hidden" name="id" id="imageId">
                                            <a class="btn btn-danger" href="/phone/public/destroyImage/{{ $imageList->id }}/{{ $product->id }}" onclick="return confirm('Are you sure you want to delete this item?');"> <i class="icon-trash"></i> </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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