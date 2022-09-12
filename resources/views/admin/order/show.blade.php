@include ('admin.index')
<div class="main">
    <div class="container-fluid">


        <div class="card mb-4">

         

            <div class="card-body">
                <div class="table-responsive">

                    <div class="widget-content">
                    <table style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:10%"> Number </th>
                                        <th style="width:40%"> Customer Name </th>
                                        <th style="width:10%"> Total </th>
                                        <th style="width:10%"> Date </th>
                                        <th style="width:10%"> Active </th>
                                        <th style="width:20%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $key => $o)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$o->customer_name}}</td>
                                        <td>{{$o->total_money}}</td>
                                        <td>{{$o->created_date}}</td>
                                        @if($o->status == 0)
                                        <td>Chưa thanh toán</td>
                                        @endif
                                        <td><a class="btn btn-primary"  href="{{route('updateOrder',$o->id)}}">Đã thanh toán</a></td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                    </div>
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