@include ('admin.index')
<div class="main">
  <div class="container-fluid">
    <div class="card mb-4">
      <div class="card-header">
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><i class="fas fa-users"></i>
            DATA BRAND
            &emsp; &emsp;</li>
          <li class="breadcrumb-item"> <a href="{{route('createBrand')}}" class="btn btn-primary"> <i class="icon-plus"></i> </a> </li>
        </ol>
      </div>
      <div class="card-body">
        <div class="table-responsive">

          <div class="widget-content">
            <table style="width:100%" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width:10%"> Number </th>
                  <th style="width:20%"> Image </th>
                  <th style="width:20%"> Brand </th>
                  <th style="width:10%"> Link </th>
                  <th style="width:10%"> Active </th>
                  <th style="width:10%"> Sort Order </th>
                  <th style="width:20%"> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach($brandList as $key => $brandList)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td><img src="../public/images/{{$brandList->image_url}}"  width="100px" alt="Khong tai duoc"></td>
                  <td>{{$brandList->name}}</td>
                  <td>{{$brandList->link}}</td>
                  <td><input type="checkbox" class="toggle" value="{{$brandList->id}}" data-size="mini"  data-id="{{$brandList->id}}" data-on="Enabled" data-off="Disabled" {{$brandList->active == 1 ? 'checked' : ''}}  data-toggle="toggle" data-width="20" data-height="10"></td>
                  <td>{{$brandList->sort_order}}</td>
                  <td>
                    <form method="post" action="">
                      <input value="{{$brandList->id}}" type="hidden" name="id" id="">
                      <a class="btn btn-success" href="{{route('editBrand', $brandList->id)}}"> <i class="icon-edit"></i> </a> &emsp;
                      <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" href="{{route('destroyBrand', $brandList->id)}}"> <i class="icon-trash"></i> </a> &emsp;
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
    $(document).ready(function() {

        $('.toggle').on('change',function(){
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id'); 
            var _token = '{{csrf_token()}}';
            $.ajax({
                url: "{{route('activeBrand')}}",
                method: 'POST',
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