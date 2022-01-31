<!DOCTYPE html>
<html lang="en">

<head>
  @include('employee_partials.empdash')
</head>

<body>
  @csrf

  @include('admin_partials.topnav')
  @include('employee_panel.employeenav')

  @include('employee_panel.empboard')




  <footer class="container-fluid text-center">
    <p>&copy 2021 Online Order. All rights reserved</p>
  </footer>


  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>