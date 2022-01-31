<!DOCTYPE html>
<html>

<head>
  <title>Online Order</title>

  @include('admin_partials.head')
  @include('admin_partials.edithead')

</head>

<body>
  @include('admin_partials.topnav')

  @csrf


  <div class="sign-img">

    <div class="main-body">


      <form action="{{ route('views.updateadmin')}}" method="post">
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
        <h4 class="top"> Please Remember or Note Down Userid & Password</h4>

        <h3 style=" text-align:center;color:red;"><strong>Admin</strong></h3>

        <label class="uname" for="uname"><b>User Id </b></label>
        <input type="text" name="userid" value="{{ isset($userid) ? $userid : 'Account Not Validate'}}">
        <br>

        <label for="upassword"><b>Password</b></label>

        <input type="text" name="password" value="{{ isset($password) ? $password : 'Account Not Validate'}}">

        <br>

        <button class="button btn btn-warning" type="submit" style="background-color:#f0ad4e;">Update</button>

      </form>

    </div>

  </div>





</body>
<script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="{{ URL::asset('js/pso_js/bootstrape.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/pso_js/dataTables.js') }}"></script>

</html>