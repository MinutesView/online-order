<!DOCTYPE html>
<html>
<head>
  
	<title>Online Order</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />



</head>
<body>

<div class="bg-img">
  <form class="container" action="{{ route('views.signin')}}" method="post">
  @csrf
    <h1>Login</h1>

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
	<label for="uname"><b>UserID</b></label>
    <input type="text" placeholder="Enter UserID" name="userid"  value="{{ old( 'userid') }}" required>
    
    <span class="text-danger"> @error('userid'){{ $message }} @enderror </span>
<br>

    <label for="upassword"><b>Password</b></label>
    
    <input type="password" id="password" placeholder="Enter Password" name="password" required>
    <i class="far fa-eye" id="togglePassword"></i>

    <span class="text-danger"> @error('password'){{ $message }} @enderror </span>
<br>

    <select name="position" id="position" required>
    <option value="">Select Position</option>
    <option value="admin">Admin</option>
    <option value="pso">PSO</option>
    <option value="employee">Employee</option>
    <option value="customer">Customer</option>
  </select>

    <button type="submit" class="btn">Login</button>


    <a href="register">Create a Customer Account now!</a>
    
  </form>

  
</div>


<script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

</body>
</html>
