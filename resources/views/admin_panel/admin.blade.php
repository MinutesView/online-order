<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin_partials.head')

</head>

<body>
  @csrf

  @include('admin_partials.topnav')
  @include('admin_panel.adminnav')



  @include('admin_panel.adminboard')



  <footer class="container-fluid text-center">
    <p>&copy 2021 Online Order. All rights reserved</p>
  </footer>



  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>