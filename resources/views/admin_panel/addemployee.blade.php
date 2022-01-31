<!DOCTYPE html>
<html>


<head>

  @include('admin_partials.adminhead')
  @include('admin_partials.head')

</head>

<body class="w3-light-grey">
  @csrf

  @include('admin_partials.topnav')
  @include('admin_panel.adminnav')

  <div>
    <h3>New Employee</h3>

  </div>

  <div class="add col-md-8">
    <form action="{{ route('views.createemployee')}}" method="post">
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

        @if(count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>

      <label for="eid">Employee ID</label>
      <input type="text" id="eid" name="eid" value="{{$empid+1}}" readonly>

      <label for="name">Employee Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter Employee Name" value="{{ old( 'name') }}">

      <label for="designation">Designation</label>

      <input type="text" id="designation" name="designation" placeholder="Enter Employee designation" value="{{ old( 'designation') }}">

      <label for="password">Temporary Password</label>

      <input type="text" id="password" placeholder="Enter Temporary Password" name="password" required>
      <br>
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option value="">Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <input type="submit" value="Add Employee">
    </form>
  </div>




  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>