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

  @include('employee_panel.employeenav')
  <div>
    <h3>Modify Old PSO</h3>

  </div>

  <div class="add col-md-8">
    <form action="{{ route('views.updateemployeeprofile')}}" method="post">
      @csrf

      <div class="results">
        @if(Session::get('success'))
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>
        @endif
        @if(Session::get('fail'))
        <div class="alert alert-danger">
          {{Session::get('fail')}}
        </div>
        @endif
      </div>

      @if(count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <label for="eid">Employee ID</label>
      <input type="text" id="psocode" name="empid" value="{{$employee->empid }}" readonly>

      <label for="name">Full Name</label>
      <input type="text" id="psoname" name="empname" placeholder="Enter Full Name" value="{{$employee->empname }}">

      <br>
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option value="{{$employee->gender }}" disabled style="display:none;">{{$employee->gender }}</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>


      <label for="designation">Designation</label>
      <input type="text" id="address" name="designation" placeholder="Enter Designation" value="{{$employee->designation }}">

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter New Password">

      <input type="submit" value="Update Profile">
    </form>
  </div>

  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>