<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      
      <a class="navbar-brand" href="">Online Order</a>
    </div>


    <ul class="nav-item navbar-right dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"> </i> @if(Session::has('name'))
    {{Session::get('name')}}
    @endif <i class="fa fa-caret-down m"></i></a>
      <div class="dropdown-menu dropdown-container" aria-labelledby="navbarDropdown"> 
        
        @if(Session::has('LoggedEmployee'))

        <li><a id="drop-button" href="/employeeprofile"><strong>Profile</strong></a></li>
          <li><a id="drop-button" href="/logout"><strong>Logout</strong></a></li>

          @elseif(Session::has('LoggedPso'))

          <li><a id="drop-button" href="/psoprofile"><strong>Profile</strong></a></li>
          <li><a id="drop-button" href="/logout"><strong>Logout</strong></a></li>

          @elseif(Session::has('LoggedCustomer'))

          <li><a id="drop-button" href="/customerprofile"><strong>Profile</strong></a></li>
          <li><a id="drop-button" href="/logout"><strong>Logout</strong></a></li>

          @elseif(Session::has('LoggedAdmin'))

          <li><a id="drop-button" href="/editadmin"><strong>Profile</strong></a></li>
          <li><a id="drop-button" href="/logout"><strong>Logout</strong></a></li>
          @else
          @endif
      </div>
    </ul>

    <!-- topnav right -->
  </div>

</nav>