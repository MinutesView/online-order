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
  @include('customer_panel.customernav')

  <div>
    <h3>Modify Old PSO</h3>

  </div>

  <div class="add col-md-8">
    <form action="{{ route('views.updatecustomer')}}" method="post">
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

      <label for="eid">Customer Code</label>
      <input type="text" id="psocode" name="customerCode" value="{{$customer->customerCode }}" readonly>

      <label for="name">Full Name</label>
      <input type="text" id="psoname" name="customerName" placeholder="Enter Full Name" value="{{$customer->customerName }}">

      <label for="eid">PSO Code</label>
      <input type="text" id="psocode" name="psocode" value="{{$customer->psocode }}" readonly>

      <label for="designation">Address</label>
      <input type="text" id="address" name="address" placeholder="Enter Address" value="{{$customer->address }}">

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter New Password">

      <input type="submit" value="Update Profile">
    </form>
  </div>




  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>