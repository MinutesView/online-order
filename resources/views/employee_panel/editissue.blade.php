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

  @if(session()->has('LoggedAdmin'))
  @include('admin_panel.adminnav')
  @else
  @include('employee_panel.employeenav')
  @endif

  <div>
    <h3>Modify Existing Issue From Inventory</h3>

  </div>

  <div class="add col-md-8">

    <form action="{{ route('views.updateissue')}}" method="post">
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

      <input type="hidden" name="issueCode" value="{{$inventoryCode->issueCode }}">
      <label for="eid">Product Code</label>
      <input type="text" id="name" name="productCode" value="{{$inventoryCode->productCode }}">

      <label for="eid">Product Name</label>
      <input type="text" id="name" name="productName" placeholder="Enter Product Name" value="{{$inventoryCode->productName}}">

      <label for="eid">Loading Number</label>
      <input type="text" id="name" name="loadingNo" placeholder="Enter Loading Number" value="{{$inventoryCode->loadingNo}}">

      <label for="eid">Issue Reason</label>
      <input type="text" id="name" name="issueDetails" placeholder="Enter Reason (ex: Expired)" value="{{$inventoryCode->issueDetails}}">


      <label for="name">Quantity</label>
      <input type="text" id="name" name="quantity" placeholder="Issue Quantity" value="{{$inventoryCode->quantity}}">


      <br>
      <label for="eid">Issue Date</label>
      <input type="date" id="name" name="date" value="{{ date('Y-m-d') }}" style=" width: 350px; height:40px; margin-right:20px;">

      <label for="name">Status</label>

      <select name="issuestatus" id="name" style=" width: 350px;" required>
        <option value="">Select Status</option>
        <option value="0">Pending</option>
        <option value="1">Solved</option>
      </select>
      <br>

      <label for="name">Employee ID</label>
      <input type="text" id="eid" name="empid" placeholder="Employee id" value="@if(Session::has('LoggedEmployee'))
    {{Session::get('LoggedEmployee')}}
    @endif" readonly>

      <br>

      <input type="submit" value="Update Issue">
    </form>
  </div>

  <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
</body>

</html>