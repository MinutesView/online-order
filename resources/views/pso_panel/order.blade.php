<!DOCTYPE html>
<html lang="en">

<head>
    @include('employee_partials.empmain')
</head>

<body>
    @csrf

    @include('admin_partials.topnav')

    @include('pso_panel.psonav')

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

    <div class="row">
    <br>
        <div class="col-sm-5">
            <table id="datatable" class="table table-bordered yajra-datatable">
                <thead>
                    <tr class="table-head">
                        <th>Product Code</th>
                        <th> Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $row)
                    <tr>
                        <form action="{{ route('views.addcart')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $row->productCode }}">
                            <input type="hidden" name="name" value="{{ $row->productName }}">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="{{ $row->productRate }}">
                            <input type="hidden" name="tax" value="15">

                            <td>{{$row-> productCode }} </td>
                            <td>{{$row-> productName }} </td>
                            <td>{{$row-> quantity }} </td>
                            <td>{{$row-> productRate }}</td>
                            <td><button type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>



        <!-- Right Side-->

        <div class="col-sm-5">



                <div class="price_card text-center">
                    <ul class="price-features" style="border: 1px solid grey;">
                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th class="text-white">Code</th>
                                    <th class="text-white">Product Name</th>
                                    <th class="text-white">Quantity</th>
                                    <th class="text-white">Price</th>
                                    <th class="text-white">Sub Total</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            @php
                            $cartProduct=Cart::content()
                            @endphp

                            <tbody>
                                @foreach($cartProduct as $val)
                                <tr>
                                    <th>{{$val->id}}</th>
                                    <th>{{$val->name}}</th>
                                    <th>{{$val->qty}}</th>
                                    <th>{{$val->price}}</th>
                                    <th>{{$val->price*$val->qty}}</th>
                                    <th><a href="{{ route('views.removecart',$val->rowId)}}"><i class="fas fa-trash-alt text-danger"></i></a></th>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </ul>
                    <div class="pricing-footer bg-primary">
                        <p style="font-size: 15px;">Quantity: {{Cart::count()}}</p>
                        <p style="font-size: 15px;">Sub Total: {{Cart::subtotal()}}</p>
                        <p style="font-size: 15px;">Vat: {{Cart::tax()}}</p>
                        <hr>
                        <p>
                        <h2 class="text-white">Total : {{ Cart::total() }}</h2>
                        </p>

                    </div>
                    <form action="{{ route('views.submitcart')}}" method="post">
                @csrf
                <div class="panel">
                    <select class="form-control" name="customerCode">
                        <option disabled="" selected="">Select Customer</option>
                        @foreach($customer as $cus)
                        <option value="{{$cus->customerCode}}">{{$cus->customerCode}} <span> {{$cus->customerName}}</span></option>
                        @endforeach

                    </select>
                </div>


                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="totalQuantity" value="{{Cart::count()}}">
                    <input type="hidden" name="subTotal" value="{{Cart::subtotal()}}">
                    <input type="hidden" name="productVat" value="{{Cart::tax()}}">
                    <input type="hidden" name="grandTotal" value="{{ Cart::total() }}">
                    <input type="hidden"  name="empid" value="@if(Session::has('LoggedPso')){{Session::get('LoggedPso')}}@endif">
                       
                    <button class="btn btn-success">Submit</button>
                    
            </form>
                </div>

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


<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
    });
</script>

</html>