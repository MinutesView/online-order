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
    <link rel="stylesheet" href="{{ URL::asset('css/signup.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/pso_css/topnav.css') }}" />
</head>

<body>

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

    <div class="sign-img">

        <div class="main-body">


            <form action="{{ route('views.complete')}}" method="post">
                @csrf

                <input type="hidden" name="empid" value="@if(Session::has('LoggedCustomer')){{Session::get('LoggedCustomer')}}@endif">
                <h4 class="top">If your product hasn't Delivered yet, Please do not Submit.</h4>
                <label class="uname" for="uname"><b>Invoice No.</b></label>
                <input type="text" name="memoNo" placeholder="Invoice Number" value="">
                <br>
                <p>* By clicking submit you are agreeing that you received product correctly.</p>

                <br>

                <button class="button" type="submit">Submit</button>


            </form>

        </div>

    </div>





</body>

</html>