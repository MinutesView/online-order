<!DOCTYPE html>
<html>
<head>
	<title>Online Order</title>
  
  <!-- Bootstrap (css) & Javascript source links -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="{{ URL::asset('css/signup.css') }}" />

  <link rel="stylesheet" href="{{ URL::asset('css/pso_css/topnav.css') }}" />
</head>

<body>

@csrf


<div class="sign-img">

<div class="main-body">

  <h4  class="top"> Please Remember or Note Down Userid & Password</h4>

 

    <label class="uname" for="uname"><b>User Id  </b></label>
    <input type="text" name="psoname" value="{{ isset($userid) ? $userid : 'Account Not Created'}}" readonly>
    <br>

    <label for="upassword"><b>Password</b></label>
    
    <input type="text" name="psoname" value="{{ isset($password) ? $password : 'Account Not Created'}}" readonly>

<br>

  <button class="button"  type="button" onclick=window.location='{{ url("admin") }}'>Okey</button>


  </div>

</div>





</body>
</html>