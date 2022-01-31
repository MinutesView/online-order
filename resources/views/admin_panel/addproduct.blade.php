<!DOCTYPE html>
<html lang="en">


<head>

  @include('admin_partials.adminhead')
  @include('admin_partials.head')
</head>

<body>
  @csrf

  @include('admin_partials.topnav')

  @include('employee_panel.employeenav')



  <div>
    <h3>Add New Product</h3>

  </div>

  <div class="add col-md-8">

    <form action="{{ route('views.createproduct')}}" method="post">
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
      <input type="text" id="eid" name="eid" value="{{$productCode+1}}" readonly>

      <label for="productRate">Loading Number</label>
      <input type="text" id="name" name="loadingNo" placeholder="Enter Loading Number" value="{{ old( 'loadingNo') }}">

      <label for="productRate">Product Name</label>
      <input type="text" id="name" name="productName" placeholder="Enter Product Name" value="{{ old( 'productName') }}">

      <label for="productRate">Product Rate</label>
      <input type="text" id="name" name="productRate" placeholder="Enter Product Rate" value="{{ old( 'productRate') }}">

      <label for="name">Product Vat (percent)</label>
      <input type="text" id="name" name="productVat" placeholder="Enter Vat (ex: 15)" value="{{ old( 'productVat') }}">

      <label for="name">Quantity</label>
      <input type="text" id="name" name="quantity" placeholder="Total Quantity" value="{{ old( 'quantity') }}">
      <br>
      <br>
      <label for="name">Receive Date : </label>
      <input type="date" id="name" name="receivedDate" value="{{ old( 'receivedDate') }}">

      <label id="date" for="expDate">Expiry Date :</label>
      <input type="date" id="name" name="expDate" value="{{ old( 'expDate') }}">
      <br>
      <br>
      <label for="name">Employee ID</label>
      <input type="text" id="eid" name="empid" placeholder="Employee id" value="@if(Session::has('LoggedEmployee'))
    {{Session::get('LoggedEmployee')}}
    @endif" readonly>


      <br>
      <input type="submit" value="Add Product">
    </form>
  </div>



  <script>
    var dropdown = document.getElementsById("product");
    this.classList.toggle("active");
  </script>
  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>