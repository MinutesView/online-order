<!DOCTYPE html>
<html>
<title>Online Order</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<body class="w3-light-grey">



  <!-- !PAGE CONTENT! -->
  <div class="w3-main col-md-9">

    <div class="w3-row-padding w3-margin-bottom" style="margin-top:70px;">
      <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16">
          <div class="w3-left"><i class="fa fa-cart-plus w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$order}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>New Order</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container w3-green w3-padding-16">
          <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$pending}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Delivery Pending</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container w3-light-green w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fas fa-warehouse w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$quantity}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Stock Available</h4>
        </div>
      </div>

      <div class="w3-quarter">
        <div class="w3-container  w3-lime w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-exclamation-circle w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$issue}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Inventory Issue</h4>
        </div>
      </div>
      <hr>


      <div class="w3-quarter" style="margin-top:70px;">
        <div class="w3-container  w3-indigo w3-padding-16">
          <div class="w3-left"><i class="fa fa-user-cog w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$admin}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Admin</h4>
        </div>
      </div>



      <div class="w3-quarter" style="margin-top:70px;">
        <div class="w3-container  w3-blue w3-padding-16">
          <div class="w3-left"><i class="fa fa-users-cog w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$employee}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Employee</h4>
        </div>
      </div>



      <div class="w3-quarter" style="margin-top:70px;">
        <div class="w3-container  w3-cyan w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-user-edit w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$pso}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>PSO</h4>
        </div>
      </div>



      <div class="w3-quarter" style="margin-top:70px;">
        <div class="w3-container  w3-light-blue w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$customer}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Buyer</h4>
        </div>
      </div>




    </div>


  </div>




</body>

</html>