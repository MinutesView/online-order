  <div class="col-sm-3 sidenav hidden-xs">
    <ul class="nav nav-pills nav-stacked">
      <br>

      <li><a id="anchor" href="/admin">Admin Dashboard</a></li>

      <button class="dropdown-btn">Order
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="{{route('pendingorder')}}">Order Pending</a></li>
        <li><a href="{{route('manageorder')}}">Manage Order</a></li>
      </div>


      <button class="dropdown-btn">Product
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="{{route('manageproduct')}}">Edit Product</a></li>
        <li><a href="{{route('manageproduct')}}">Manage Product</a></li>
      </div>
      
      <button class="dropdown-btn">Inventory Issue
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="/issue">Check Issue</a></li>
        <li><a href="{{route('pendingissue')}}">Pending Issue</a></li>
        <li><a href="{{route('manageissue')}}">Manage Issue</a></li>
      </div>



      <button class="dropdown-btn" href="#">Employee
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="{{route('addemployee')}}">Add New Employee</a></li>
        <li><a href="{{route('manageemployee')}}">Manage Employee</a></li>
      </div>



      <button class="dropdown-btn" href="#">PSO
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="{{route('addpso')}}">Add New PSO</a></li>
        <li><a href="{{route('managepso')}}">Manage PSO</a></li>
      </div>



      <button class="dropdown-btn" href="#">Customer
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <li><a href="{{route('managecustomer')}}">PSO & Customer</a></li>
        <li><a href="{{route('managecustomer')}}">Manage Customer </a></li>
      </div>


  </div>