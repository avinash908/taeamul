<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{__('Dashboard')}} - @yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/trix.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/tagger.css') }}">

  <!-- <link rel="stylesheet" href="{{ asset('assets/admin/vendors/file-manager/css/file-manager.css') }}"> -->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/image-uploader.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/jquery.tagsinput-revisited.css')}}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" defer></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  


  <script type="text/javascript" src="{{ asset('assets/admin/js/tagger.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/trix.js') }}"></script>
  

  @yield('css')

  <link rel="stylesheet" href="{{ asset('assets/admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}" />
  <style type="text/css">
  div.tagsinput span.tag {
      background: #282f3a !important;
      color: #ffffff;
      line-height: 1.4;
      padding: 8px 24px !important;
  }
    .delete-options {
      position: absolute;
      margin: auto;
      right: 46px;
      background-color: red;
      color: white;
      padding: 5px;
      font-size: 0.8rem;
      cursor: pointer;
  }
  </style>
</head>
<body>

  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('/')}}" target="_blank"><img src="{{asset('assets/images/logo.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('/')}}" target="_blank"><img src="{{asset('assets/images/logo.png')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text mb-0">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text mb-0">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text mb-0">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-email-outline mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="{{asset('assets/admin/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="{{asset('assets/admin/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="{{asset('assets/admin/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('assets/admin/images/faces/face1.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="{{route('admin.profile')}}" class="dropdown-item">
                <i class="mdi mdi-account text-primary"></i>
                {{__('Profile')}}
              </a>
              <a href="{{route('admin.settings')}}" class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                {{__('Settings')}}
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                 <i class="mdi mdi-logout text-primary"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{route('admin.logout')}}" method="POST"
                style="display: none;">
                @csrf
            </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
          <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
              <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
              <span class="menu-title">{{__('Dashboard')}}</span>
            </a>
          </li>
          @if(auth()->guard('admin')->user()->can('can manage orders'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-cart-outline menu-icon"></i>
              <span class="menu-title">{{__('Orders')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders','all')}}">{{__('All Orders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders','pending')}}">{{__('Pending Orders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders','processing')}}">{{__('Processing Orders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders','completed')}}">{{__('Completed Orders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders','declined')}}">{{__('Declined Orders')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage products'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-puzzle-outline menu-icon"></i>
              <span class="menu-title">{{__('Products')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('products.index')}}">{{__('All Products')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('products.create')}}">{{__('Upload Product')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.deactiveproducts')}}">{{__('Deactivated Products')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage customers'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('admin.customers')}}">
              <i class="mdi mdi-account-outline menu-icon"></i>
              <span class="menu-title">{{__('Customers')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage vendors'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#vendor" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account-network menu-icon"></i>
              <span class="menu-title">{{__('Vendors')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="vendor">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.vendors')}}">{{__('Vendors List')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.vendor.payment.withdraws')}}">{{__('Vendors Withdraw')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.payment.settings')}}">{{__('Payment Settings')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage categories'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
              <span class="menu-title">{{__('Maintain Categories')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('categories.index')}}">{{__('Main Category')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('subcategories.index')}}">{{__('Sub Category')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('childcategories.index')}}">{{__('Child Category')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage pages'))
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-file-outline menu-icon"></i>
              <span class="menu-title">{{__('Pages')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('faqs.index')}}">{{__('FAQ Page')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.contact_details')}}">{{__('Contact Us Page')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('pages.index')}}">{{__('Other Pages')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage blog'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">{{__('Blog')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog">
               <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.posts')}}">{{__('Posts')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.create.post')}}">{{__('Create Post')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.categories')}}">{{__('Categories')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.create.category')}}">{{__('Create Category')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.comments')}}">{{__('Comments')}}</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage seo'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('admin.seo')}}">
              <i class="mdi mdi-search-web menu-icon"></i>
              <span class="menu-title">{{__('Seo')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage messages'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('msg.show')}}">
              <i class="mdi mdi-message-text-outline menu-icon"></i>
              <span class="menu-title">{{__('Messages')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage product reviews'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('product.review')}}">
              <i class="mdi mdi-comment-account-outline menu-icon"></i>
              <span class="menu-title">{{__('Product Reviews')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage wholesale units'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('wholesaleunits.index')}}">
              <i class="mdi mdi-plus menu-icon"></i>
              <span class="menu-title">{{__('Wholesale Units')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage banners'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('banners.index')}}">
              <i class="mdi mdi-image-area menu-icon"></i>
              <span class="menu-title">{{__('Banners')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage coupons'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('coupon.index')}}">
              <i class="mdi mdi-gift menu-icon"></i>
              <span class="menu-title">{{__('Coupons')}}</span>
          </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage subscribers'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('subscriber.index')}}">
              <i class="mdi mdi-account-check menu-icon"></i>
              <span class="menu-title">{{__('Subscribers')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->can('can manage language translation'))
          <li class="nav-item">
            <a class="nav-link"  href="{{url('/languages')}}">
              <i class="mdi mdi-google-translate menu-icon"></i>
              <span class="menu-title">{{__('Language Settings')}}</span>
            </a>
          </li>
          @endif
          @if(auth()->guard('admin')->user()->hasrole('admin'))
          <li class="nav-item">
            <a class="nav-link"  href="{{route('staffs.index')}}">
              <i class="mdi mdi-security-account-outline menu-icon"></i>
              <span class="menu-title">{{__('Manage Staffs')}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('roles.index')}}">
             <i class="mdi mdi-lock-outline menu-icon"></i>
                <span class="menu-title">{{__('Manage Roles')}}</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- partial -->
        <div class="main-panel">
          <div class="loader-wrap" id="t_loading" style="display:none;width: 100%;height: 100%;position: fixed;background-color: #fbfbfbcc;z-index: 999;">
              <div id="t_loader" class="dot-opacity-loader" style="position:fixed;top:50%;left:50%;z-index: 1000">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          <div class="content-wrapper">
            @yield('content')
          </div>
        </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- <script src="{{ asset('assets/admin/vendors/file-manager/js/file-manager.js') }}"></script> -->
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/admin/js/template.js') }}"></script>
  <script src="{{ asset('assets/admin/js/settings.js') }}"></script>
  <script src="{{ asset('assets/admin/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/admin/js/formpickers.js') }}"></script>
  <!-- End custom js for this page-->
<script type="text/javascript" src="{{ asset('assets/admin/js/data-table.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/toastDemo.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/jQuery.print.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/admin/js/image-uploader.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/jquery.tagsinput-revisited.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function ($) {

      $('#seo').on('click', function () {
        if ($(this).prop('checked')) {
          $('.seo-inputs').attr('required','required');
            $('#seo-show').fadeIn();
        } else {
          $('.seo-inputs').removeAttr('required');
            $('#seo-show').hide();
        }
      });
      
      $('#meta_tags').tagsInput({

        // allows new tags
        interactive: true,

        // custom placeholder
        placeholder: 'Keyword1, Keyword2, Keyword3 ..... ',

        // width/height
        width: 'auto',
        height: 'auto',

        // hides the regular input field
        hide: true,

        // custom delimiter
        delimiter: ',',

        // removes tags with backspace
        removeWithBackspace: true

    });
    $(document).on('click','.t_deactive',function () {
      var  url = $(this).attr('data-url');
      $.ajax({
          url:url,
          type:'GET',
          success:function(data){
            table.ajax.reload();
            success(data.success);
          }
      });
    });

    $(document).on('click','.t_active',function () {
      var  url = $(this).attr('data-url');
      $.ajax({
          url:url,
          type:'GET',
          success:function(data){
            table.ajax.reload();
            success(data.success);
          }
      });
    });

    $(document).on('click','.t_delete',function(){

      var url = $(this).attr('data-url');

      swal({
        title: 'Are you sure?',
        text: "Maybe You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "btn btn-danger",
            closeModal: true,
          },
          confirm: {
            text: "YES",
            value: true,
            visible: true,
            className: "btn btn-primary",
            closeModal: true
          }
        }
      }).then(function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url:url,
            type:'DELETE',
            data:{'_token':'<?=csrf_token()?>'},
            success:function(data){
              if(data.msg == 'success'){
                table.ajax.reload();
                swal({
                  title: 'Deleted!',
                  text: data.success,
                  icon: 'success',
                  timer: 3000
                });
              }else{
                if(data.msg == 'danger'){
                  swal({
                    title: 'Alert!',
                    text: data.danger,
                    icon: 'warning',
                  });
                }else{
                  swal({
                    title: 'Opps!',
                    text: 'Something went wrong while deleting!',
                    icon: 'info',
                  });
                }
              }
            }
          });
        }
      })
    });
  })
</script>
<!-- <script type="text/javascript" src="{{ asset('admin/js/desktop-notification.js')}}"></script> -->
@include('admin.partials.success')
@include('admin.partials.danger')
@yield('javascript')
</body>
</html>