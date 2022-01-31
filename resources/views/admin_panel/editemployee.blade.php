<!DOCTYPE html>
<html>


<head>
  @include('admin_partials.head')


  <link rel="stylesheet" href="{{ URL::asset('css/admin_css/editpso.css') }}" />

  <link rel="stylesheet" href="{{ URL::asset('css/pso_css/topnav.css') }}" />
</head>

<body class="w3-light-grey">
  @csrf

  @include('admin_partials.topnav')

  @include('admin_panel.adminnav')


  <div>
    <h3>Modify Old Employee</h3>

  </div>

  <div class="add col-md-8">
    <form method="post" action="{{action('TblAdminController@updateemployee', $id)}}">
      @csrf

      @if(count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <label for="eid">Employee id</label>
      <input type="text" id="empid" name="empid" value="{{$emp->empid }}" readonly>

      <label for="name">Employee Full Name</label>
      <input type="text" id="psoname" name="empname" placeholder="Enter PSO Name" value="{{$emp->empname }}">

      <label for="designation">Designation</label>
      <input type="text" id="designation" name="designation" placeholder="Enter PSO designation" value="{{$emp->designation }}">

      <label for="password">Temporary Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Temporary Password">
      <br>
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option style="display:none;" value="{{$emp->gender}}">{{$emp->gender}}</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="other">Other</option>
      </select>


      <input type="submit" value="Update">
    </form>
  </div>




  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>