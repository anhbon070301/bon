<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ADMIN SHOP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<link href="/phone/resources/css/bootstrap.min.css" rel="stylesheet">
<link href="/phone/resources/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="/phone/resources/css/font-awesome.css" rel="stylesheet">
<link href="/phone/resources/css/style.css" rel="stylesheet">
<link href="/phone/resources/css/pages/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css" integrity="sha512-mNBK16eobgxYTbRSQhlXA6hEVqfO+o31KEctFCjcn1FytkihWQGCAB4ktjdt/NiGE6q6b09aosY0det7YQa8AA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" integrity="sha512-IJ+BZHGlT4K43sqBGUzJ90pcxfkREDVZPZxeexRigVL8rzdw/gyJIflDahMdNzBww4k0WxpyaWpC2PLQUWmMUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome-ie7.css" integrity="sha512-Gyaty1w59WIaT5TGSbAHuVHOoayE3p1R9rWHMDY/RFLRBTsB07rdrKsy4lB5kyajKXsbbuEj3FAoNKiyrm5E0Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/font/FontAwesome.otf">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="{{route('homead')}}">SHOP TECHNOLOGY </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> ADMIN <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> EGrappler.com <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="javascript:;">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li ><a href="{{ route('homead') }}"><i class="fa fa-house-user"></i><span>HOME</span> </a> </li>
        <li><a href="{{ route('indexProduct') }}"><i class="icon-inbox"></i><span>PRODUCT</span> </a> </li>
        <li><a href="{{ route('indexBanners') }}"><i class="icon-align-justify"></i><span>BANNER</span> </a> </li>
        <li><a href="{{ route('indexUser') }}"><i class="fa fa-user"></i><span>ACCOUNT</span> </a> </li>
        <li><a href="{{ route('homead') }}"><i class="icon-bullhorn"></i><span>REPORT</span> </a> </li>
        <li><a href="{{  route('indexOrder') }}"><i class="icon-shopping-cart"></i><span>ORDER</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-collapse"></i><span>CATEGORY</span> <b class="caret"></b></a>
          <ul class="dropdown-menu" >
            @foreach ($categories as $category)
            <li><a href="{{ route('showbyCate', $category->id) }}" value="{{ $category->id }}">{{ $category->name }}</a></li>
            @endforeach
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-collapse"></i><span>BRAND</span> <b class="caret"></b></a>
          <ul class="dropdown-menu" >
          @foreach ($brands as $brand)
            <li><a href="{{ route('showbyBrand', $brand->id )}}" value="{{$brand->id}}">{{ $brand->name }}</a></li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->

<!-- /main -->

<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="/phone/resources/css/js/jquery-1.7.2.min.js"></script> 
<script src="/phone/resources/css/js/excanvas.min.js"></script> 
<script src="/phone/resources/css/js/chart.min.js" type="text/javascript"></script> 
<script src="/phone/resources/css/js/bootstrap.js"></script>

<script src="../resources/js/base.js"></script> 
<script src="../resources/css/js/jquery-1.7.2.min.js"></script> 
<script src="../resources/css/js/excanvas.min.js"></script> 
<script src="../resources/css/js/chart.min.js" type="text/javascript"></script> 
<script src="../resources/css/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="../resources/css/js/full-calendar/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</body>
</html>
