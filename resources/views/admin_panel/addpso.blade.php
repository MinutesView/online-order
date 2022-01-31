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
    <h3>Add New PSO</h3>

  </div>
  <div class="add col-md-8">

    <form action="{{ route('views.createpso')}}" method="post">
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

      <label for="eid">PSO Code</label>
      <input type="text" id="eid" name="eid" value="{{$psocode+1}}" readonly>

      <label for="name">PSO Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter PSO Name" value="{{ old( 'name') }}">

      <label for="designation">Designation</label>

      <input type="text" id="designation" name="designation" placeholder="Enter PSO designation" value="{{ old( 'designation') }}">

      <label for="password">Temporary Password</label>

      <input type="text" id="password" placeholder="Enter Temporary Password" name="password" required>
      <br>

      <input type="submit" value="Add PSO">
    </form>
  </div>





  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>