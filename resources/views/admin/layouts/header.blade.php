<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('admin_assets/assets/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin Panel</title>

    <meta name="description" content="" />
    

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('admin_assets/logo.png')}}" />
    <script>
        var isOpen=!1;function checkInspectWindow(){console.clear();var n=new Date;debugger;var e=new Date;(isOpen=n<e)&&(location.reload())}checkInspectWindow();
       </script>
       <script>
        setInterval(()=>{checkInspectWindow()},1e3),document.addEventListener("keydown",function(e){(e.ctrlKey||e.metaKey||"F12"==e.key||123==e.keyCode)&&e.preventDefault()});
       </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/fonts/boxicons.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('admin_assets/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/assets/css/dataTables.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <!-- Helpers -->
    <script src="{{asset('admin_assets/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('admin_assets/assets/js/config.js')}}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      var loader = document.getElementById('loader');
    
      // Show loader
      function showLoader() {
        loader.style.display = 'flex';
        document.body.classList.add('no-scroll');
      }
    
      // Hide loader
      function hideLoader() {
        loader.style.display = 'none';
        document.body.classList.remove('no-scroll');
      }
    
      // Show loader until the whole page finishes loading
      showLoader();
    
      window.addEventListener('load', function() {

        setTimeout(() => {
          hideLoader();
        }, 1000);
       
      });
    });
    </script>
  </head>
  <body>
    <div id="loader" class="loader" style="position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgb(255,255,255);
background: radial-gradient(circle, rgba(255,255,255,0.77718837535014) 0%, rgba(0,0,0,0.8875525210084033) 100%);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    ">
      <svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
          <defs>
              <linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
                  <stop offset="0%" stop-color="#2E3192 " />
                  <stop offset="100%" stop-color="#1BFFFF" />
              </linearGradient>
              <linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#2E3192 " />
                  <stop offset="100%" stop-color="#1BFFFF" />
              </linearGradient>
          </defs>
          <circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
          <line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
      </svg>
    </div>
