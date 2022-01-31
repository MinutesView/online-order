<!DOCTYPE html>
<html>
<title>Online Order</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://raw.githubusercontent.com/vitorlans/w3-css/master/4/w3pro.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<body class="w3-light-grey">



  <!-- !PAGE CONTENT! -->
  <div class="w3-main col-md-9">

    <div class="w3-row-padding w3-margin-bottom" style="margin-top:80px;">
      <div class="w3-quarter" style="margin-left:50px;margin-right:50px;">
        <div class="w3-container w3-green w3-padding-16">
          <div class="w3-left"><i class="fa fa-cart-plus w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$order}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>New Order</h4>
        </div>
      </div>
      <div class="w3-quarter" style="margin-right:50px;">
        <div class="w3-container w3-light-green w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$pending}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Delivery Pending</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container w3-light-blue w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fas fa-warehouse w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$quantity}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Stock Available</h4>
        </div>
      </div>

    </div>



    <div class="w3-row-padding w3-margin-bottom" style="margin-top:80px;">
      <div class="w3-quarter" style="margin-left:50px;margin-right:50px;">
        <div class="w3-container w3-purple w3-padding-16">
          <div class="w3-left"><i class="fa fa-list-ul w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$product}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Total Product</h4>
        </div>
      </div>

      <div class="w3-quarter" style="margin-right:50px;">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-exclamation-circle w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$check}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Check Issue</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container  w3-red w3-padding-16">
          <div class="w3-left"><i class="fa fa-exclamation-circle w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>{{$issue}}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Inventory Issue</h4>
        </div>
      </div>

    </div>


    <div class="w3-panel">
      <div class="w3-row-padding" style="margin:0 -16px">



      </div>
    </div>
    <hr>

  </div>




</body>

</html>