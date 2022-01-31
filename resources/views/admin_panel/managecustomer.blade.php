<!DOCTYPE html>
<html>

<head>

    @include('admin_partials.managehead')
    @include('admin_partials.head')
</head>

<body>
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
    </div>
    @include('admin_partials.topnav')

    @include('admin_panel.adminnav')

    <div class="container mt-5 col-md-8">
        <h4 class="mb-3">Customer List</h4>
        <table id="pso_table" class="table table-bordered yajra-datatable">
            <thead>
                <tr class="table-head">
                    <th>Customer Id</th>
                    <th> Customer Name</th>
                    <th>PSO Code</th>
                    <th>Address</th>
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
        $('#pso_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('managecustomer.getcusdata') }}",
            "columns": [{
                    "data": "customerCode"
                },
                {
                    "data": "customerName"
                },
                {
                    "data": "psocode"
                },
                {
                    "data": "address"
                },
                {
                    "data": "action",
                    orderable: false,
                    searchable: false
                },
            ]


        });



        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");

            if (confirm("Do you want to Delete this Data?")) {
                $.ajax({
                    url: "{{route('managecustomer.removecustomer')}}",
                    method: "get",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        alert(data);
                        $('#pso_table').DataTable().ajax.reload();
                    }
                })
            } else {

            }
        });

    });
</script>



</html>