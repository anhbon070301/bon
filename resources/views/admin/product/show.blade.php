@include ('admin.index')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

<style>

.center {
  margin: auto;
  width: 50%;
  text-align: center;
  padding: 10px;
}
.pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
}

.pagination > li {
  display: inline;
}

.pagination > li > a,
.pagination > li > span {
  float: left;
  padding: 4px 12px;
  line-height: 1.428571429;
  text-decoration: none;
  background-color: #ffffff;
  border: 1px solid #dddddd;
  border-left-width: 0;
}

.pagination > li:first-child > a,
.pagination > li:first-child > span {
  border-left-width: 1px;
}

.pagination > li > a:hover,
.pagination > li > a:focus,
.pagination > .active > a,
.pagination > .active > span {
  background-color: #f5f5f5;
}

.pagination > .active > a,
.pagination > .active > span {
  color: #999999;
  cursor: default;
}

.pagination > .disabled > span,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #999999;
  cursor: not-allowed;
  background-color: #ffffff;
}

.pagination-large > li > a,
.pagination-large > li > span {
  padding: 14px 16px;
  font-size: 18px;
}

.pagination-small > li > a,
.pagination-small > li > span {
  padding: 5px 10px;
  font-size: 12px;
}
.search{
    display: flex;
    justify-content: space-between;
    height: 28px;
    width: 30%;
}
.input-search{
    border-radius: 20px;
    border: solid 1px #cccccc;
    width: 85%;
}

</style>

<div class="container">
    <div class="row">
        <div class="span12">
            
            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><i class="fas fa-users"></i>
                        DATA PRODUCT
                        &emsp; &emsp;</li>
                    <li class="breadcrumb-item "> <a href="{{ route('createProduct') }}" class="btn btn-primary"> <i class="icon-plus"></i> </a> </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">

                        <form action=" {{ route('indexProduct') }} " method="get">
                            <div class="search">
                                <input id='searchInput' class="input-search" name="searchInput" type='text' placeholder='Product Name' />
                                <button class="btn btn-primary" style="background-color: #ffffff; color: black ;border-radius: 20px;"><i class="icon-search"></i></button>
                            </div>
                        </form>
                       
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:2%"> Number </th>
                                    <th style="width:10%"> Image </th>
                                    <th style="width:25%"> Product Name </th>
                                    <th style="width:8%"> Brand </th>
                                    <th style="width:13%"> Category </th>
                                    <th style="width:5%"> Price </th>
                                    <th style="width:5%"> Old Price </th>
                                    <th style="width:3%"> Best sell </th>
                                    <th style="width:3%"> New </th>
                                    <th style="width:5%"> Order Sort </th>
                                    <th style="width:2%"> Active </th>
                                    <th style="width:19%"> Action </th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                @foreach($products as $key => $product)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td><img src="/phone/public/images/{{ $product->image }}" width="100px" alt="Khong tai duoc"></td>
                                    <td>{{ $product->name }}</td>
                                    @foreach ($brands as $brand)
                                        @if ($brand->id == $product->brand_id)
                                            <td>{{ $brand->name }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($categories as $category)
                                        @if($category->id == $product->category_id)
                                            <td>{{ $category->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ number_format($product->old_price) }}</td>
                                    @if ($product->is_best_sell == 1)
                                        <td><p style="color: #31ba35;">best</p></td>
                                    @else
                                        <td><p style="color: #ba3131;">bad</p></td>
                                    @endif
                                    @if ($product->is_new == 1)
                                        <td><p style="color: #31ba35;">new</p></td>
                                    @else
                                        <td><p style="color: #ba3131;">old</p></td>
                                    @endif
                                    <td>{{ $product->sort_order  }}</td>
                                    <input type="hidden" value="{{ $product->id }}" class="id" id="idp">
                                    <td><input type="checkbox" class="toggle mini" value="{{ $product->id }}" data-id="{{ $product->id }}" data-on="On" data-off="Off" data-size="mini" data-toggle="toggle" data-width="15" data-height="10" {{ $product->active == 1 ? 'checked' : '' }} ></td>
                                    <td>
                                        <form method="post" action="">
                                            <input value="{{ $product->id }}" type="hidden" name="id" id="tenhang">
                                            <a class="btn btn-success" href="{{  route('editProducts', $product->id)  }}"> <i class="icon-edit"></i> </a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" href="{{ route('destroyProducts', $product->id) }}"> <i class="icon-trash"></i></a>
                                                <a class="btn btn-info" href="{{ route('showImage', $product->id) }}"> <i class="icon-eye-open"></i> </a>
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
    <div class="row">
        <div class="span12">
            <div class="center">
                <div class="pagination">
                    <li>{!! $products->links() !!}</li>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.toggle').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{csrf_token()}}';
            $.ajax({
                url: "{{route('active')}}",
                method: 'GET',
                data: {
                    status: status,
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        });
    });
</script>