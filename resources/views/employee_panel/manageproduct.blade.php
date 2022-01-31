<!DOCTYPE html>
<html>

<head>

  @include('admin_partials.head')
  @include('employee_partials.emp')
  <link rel="stylesheet" href="{{ URL::asset('css/pso_css/nav.css') }}" />
</head>

<body>

  @include('admin_partials.topnav')

  @if(session()->has('LoggedAdmin'))
  @include('admin_panel.adminnav')
  @else
  @include('employee_panel.employeenav')
  @endif



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
  <div class="container md-5 col-md-9">
    <h4 class="mb-3">All Product List</h4>
    <!-- 
    <input type="hidden" id="id" name="id" value="" >
     -->
    <table id="product_table" class="table table-bordered yajra-datatable">
      <thead>
        <tr class="table-head">
          <th>P. Code</th>
          <th>Loading</th>
          <th> Product Name</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Received</th>
          <th>Expiry</th>
          <th>Employee</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>


    <div>
      {{csrf_field()}}
      <span id="form_output"></span>
    </div>
  </div>

</body>

<script type="text/javascript" src="{{ URL::asset('js/admin_js/admin.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#product_table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ route('manageproduct.getproductdata') }}",
      "columns": [{
          "data": "productCode"
        },
        {
          "data": "loadingNo"
        },
        {
          "data": "productName"
        },
        {
          "data": "productRate"
        },
        {
          "data": "quantity"
        },
        {
          "data": "receivedDate"
        },
        {
          "data": "expDate"
        },
        {
          "data": "empid"
        },
        {
          "data": "action",
          orderable: false,
          searchable: false
        },
      ]


    });



    $(document).on('click', '.edit', function() {
      var id = $(this).attr("id");

      window.location.href = "/editproduct/" + +id;


    });

    $(document).on('click', '.delete', function() {
      var id = $(this).attr("id");

      if (confirm("Do you want to Delete this Data?")) {
        $.ajax({
          url: "{{route('manageproduct.removeproduct')}}",
          method: "get",
          data: {
            id: id
          },
          success: function(data) {
            alert(data);
            $('#product_table').DataTable().ajax.reload();
          }
        })
      } else {

      }



    });



  });
</script>





</html>