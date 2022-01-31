<!DOCTYPE html>
<html>

<head>
  <title>Online Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="{{ URL::asset('css/register.css') }}" />


</head>

<body>

  <div class="bg-img">
    <form class="container" action="{{ route('views.create')}}" method="post">
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

      <h1>Customer Signup</h1>

      <label for="cname"><b>Customer Name</b></label>
      <input type="text" placeholder="Enter Fullname" name="customerName" value="{{ old( 'customerName') }}">

      <label for="pso"><b>PSO Code</b></label>
      <input type="text" placeholder="Enter PSO Code" name="psocode" required>
      <!-- Check for psocode error show-->
      <span class="text-danger"> @error('psocode'){{ $message }} @enderror </span>
      <br>
      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address" required value="{{ old( 'address') }}">

      <label for="upassword"><b>Password</b></label>
      <input type="password" id="password" placeholder="Enter Password" name="password" required>
      <i class="far fa-eye" id="togglePassword"></i>


      <button type="submit" class="btn">Signup</button>

      <a href="login">I already have account!</a>
    </form>

  </div>


  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>
</body>

</html>