<!DOCTYPE html>
<html lang="en">

<head>


  @include('admin_partials.head')
  @include('employee_partials.emphead')
  <link rel="stylesheet" href="{{ URL::asset('css/pso_css/nav.css') }}" />
</head>

<body>
  @csrf

  @include('admin_partials.topnav')

  @include('employee_panel.employeenav')


  <div>
    <h3>Edit Existing Product</h3>

  </div>

  <div class="add col-md-8">

    <form action="{{action('TblProductController@updateproduct', $id)}}" method="post">
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

      <label for="eid">Product Code</label>
      <input type="text" id="eid" name="productCode" value="{{$product->productCode }}" readonly>

      <label for="productRate">Loading Number</label>
      <input type="text" id="name" name="loadingNo" placeholder="Enter Loading Number" value="{{$product->loadingNo}}">

      <label for="productRate">Product Name</label>
      <input type="text" id="name" name="productName" placeholder="Enter Product Name" value="{{$product->productName}}">

      <label for="productRate">Product Rate</label>
      <input type="text" id="name" name="productRate" placeholder="Enter Product Price" value="{{$product->productRate}}">

      <label for="name">Product Vat (percent)</label>
      <input type="text" id="name" name="productVat" placeholder="Enter Vat (ex: 15)" value="{{$product->productVat}}">

      <label for="name">Quantity</label>
      <input type="text" id="name" name="quantity" placeholder="Total Quantity" value="{{$product->quantity}}">
      <br>
      <br>
      <label for="name">Receive Date : </label>
      <input type="date" id="name" name="receivedDate" value="{{$product->receivedDate}}">

      <label id="date" for="expDate">Expiry Date :</label>
      <input type="date" id="name" name="expDate" value="{{$product->expDate}}">
      <br>
      <br>

      @if(session()->has('LoggedAdmin'))

      <label for="name">Please Enter An Employee ID ( Default: Admin ID)</label>
      <input type="text" id="eid" name="empid" placeholder="Employee id" value="{{Session::get('LoggedAdmin')}}" required>
      @else
      <label for="name">Employee ID</label>
      <input type="text" id="eid" name="empid" placeholder="Employee id" value="@if(Session::has('LoggedEmployee'))
    {{Session::get('LoggedEmployee')}}
    @endif" readonly>

      @endif

      <br>

      <input type="submit" value="Update Product" style="background-color: #007bff;">
    </form>
  </div>


  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>