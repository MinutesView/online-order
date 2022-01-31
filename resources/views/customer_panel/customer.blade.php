<!DOCTYPE html>
<html>

<head>

    <title>Online Order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @include('admin_partials.head')

</head>

<body class="w3-light-grey" style="background-image: url('/images/img4.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;">
    @csrf
    @include('admin_partials.topnav')

    @include('customer_panel.customernav')

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



    <!-- !PAGE CONTENT! -->
    <div class="w3-main col-md-9">

        <div class="w3-row-padding w3-margin-bottom" style="margin-top:120px;">
            <div class="w3-quarter" style=" margin-left:180px;">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><i class="fa fa-list-ul w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>{{$order}}</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>My Order</h4>
                </div>
            </div>



            <div class="w3-quarter">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>{{$pending}}</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Delivery Pending</h4>
                </div>
            </div>


        </div>

        <div class="w3-quarter" style="margin-top:30px; margin-left:300px;">
            <div class="w3-container w3-light-green w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>Confirmation</h3>
                </div>

                <div class="w3-clear"></div>

                <form action="{{ route('views.confirm')}}" method="post">
                    @csrf
                    <div>
                        <input type="hidden" name="empid" value="@if(Session::has('LoggedCustomer')){{Session::get('LoggedCustomer')}}@endif">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" style=" margin-left:80px;">Proceed</button>

                    </div>

                </form>

            </div>
        </div>


    </div>




</body>

</html>