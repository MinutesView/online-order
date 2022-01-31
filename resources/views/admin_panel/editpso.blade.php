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
    <h3>Modify Old PSO</h3>

  </div>

  <div class="add col-md-8">
    <form method="post" action="{{action('TblAdminController@updatepso', $id)}}">
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

      <label for="eid">PSO Code</label>
      <input type="text" id="psocode" name="psocode" value="{{$pso->psocode }}" readonly>

      <label for="name">PSO Full Name</label>
      <input type="text" id="psoname" name="psoname" placeholder="Enter PSO Name" value="{{$pso->psoname }}">

      <label for="designation">Designation</label>
      <input type="text" id="designation" name="designation" placeholder="Enter PSO designation" value="{{$pso->designation }}">

      <label for="password">Temporary Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Temporary Password">

      <input type="submit" value="Update PSO">
    </form>
  </div>




  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>