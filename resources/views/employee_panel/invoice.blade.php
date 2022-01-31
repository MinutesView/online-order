<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin_partials.head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/pso_css/nav.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/pso_css/topnav.css') }}" />
</head>

<body>
    @csrf

    @include('admin_partials.topnav')
    @if(session()->has('LoggedAdmin'))
    @include('admin_panel.adminnav')

    @elseif(session()->has('LoggedEmployee'))
    @include('employee_panel.employeenav')

    @elseif(session()->has('LoggedPso'))
    @include('pso_panel.psonav')

    @else
    <div style="margin-left: 135px;">
        @include('customer_panel.customernav')
    </div>
    @endif


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-right"><strong>Renata Limited</strong></h4>

                                    </div>

                                    @if(Session::has('LoggedEmployee') || Session::has('LoggedAdmin'))
                                    <div class="pull-right">
                                        <h4>Invoice No. <br>
                                            <strong>{{$order->memoNo}}</strong>
                                        </h4>
                                    </div>
                                    @else
                                    <div class="pull-right">
                                        <h4>Delivery Status<br>
                                            @if($order-> orderStatus < 2) <strong>Pending</strong>
                                                @elseif($order-> orderStatus == 2)
                                                <strong>Delivered</strong>
                                                @else
                                                <strong>Completed</strong>
                                                @endif
                                        </h4>
                                    </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-left m-t-30">
                                            <address>
                                                <strong>Name: </strong>{{$customer->customerName}}<br>
                                                <strong>Customer Code: </strong>{{$order->customerCode}}<br>
                                                <strong>Address: </strong>{{$order->address}}<br>
                                            </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p class="m-t-10"><strong>Order ID: </strong>{{$order->orderNo}}</p>
                                            <p class="m-t-10"><strong>Order by: </strong>{{$order->psocode}}</p>
                                            <p><strong>Order Date: </strong>{{$order->date}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Code</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Cost</th>
                                                         <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $s=1;
                                                    @endphp
                                                    @foreach ($orderdetails as $details)
                                                    <tr>
                                                        <td>{{$s++}}</td>
                                                        <td>{{$details->productCode}}</td>
                                                        <td>{{$details->productName}}</td>
                                                        <td>{{$details->quantity}}</td>
                                                        <td>{{$details->price}} tk</td>
                                                        <td>{{$details->subTotal}} tk</td>
                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="border-radius: 0px;">
                                    <div class="col-md-3 col-md-offset-9">
                                        <p class="text-right"><b>Sub-total:</b> {{$order->subTotal}} tk</p>
                                        <p class="text-right"><b>Quantity:</b> {{$order->totalQuantity}}</p>
                                        <p class="text-right"><b>VAT:</b> {{$order->productVat}} tk</p>
                                        <hr>
                                        <h3 class="text-right">Total: {{$order->grandTotal}} Tk</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">

                                    @if(Session::has('LoggedEmployee'))
                                    @if($order ->orderStatus < 2) <form action="{{ route('views.submit')}}" method="post">
                                        @csrf
                                        <div class="pull-right">
                                            <a onclick="window.print()" class="btn btn-inverse waves-effect waves-light" style="background-color:#333333;color:white;"><i class="fa fa-print"></i></a>

                                            <input type="hidden" name="orderNo" value="{{$order->orderNo}}">
                                            <input type="hidden" name="empid" value="@if(Session::has('LoggedEmployee')){{Session::get('LoggedEmployee')}}@endif">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

                                        </div>

                                        </form>

                                        @endif

                                        @elseif(Session::has('LoggedAdmin'))
                                        <div class="pull-right">
                                            <input type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='manageorder'" value="OK" />

                                        </div>
                                        @elseif(Session::has('LoggedPso'))
                                        <div class="pull-right">
                                            <input type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='psoorder'" value="OK" />

                                        </div>

                                        @else
                                        <div class="pull-right">
                                            <input type="button" class="btn btn-primary waves-effect waves-light" onclick="location.href='customerorder'" value="OK" />

                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>


    <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>