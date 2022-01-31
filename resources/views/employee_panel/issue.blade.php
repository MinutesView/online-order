<!DOCTYPE html>
<html lang="en">

<head>

    @include('employee_partials.empissue')

</head>

<body>
    @csrf

    @include('admin_partials.topnav')

    @if(session()->has('LoggedAdmin'))
    @include('admin_panel.adminnav')
    @else
    @include('employee_panel.employeenav')
    @endif


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
        <h3 style="color: blue; text-align: center;">Issue Found</h3>
        <p>Please Submit all Issue.</p>
        <div class="col-sm-9">
            <table id="datatable" class="table table-bordered yajra-datatable">
                <thead>
                    <tr class="table-head">
                        <th>Product Code</th>
                        <th> Product Name</th>
                        <th>Expired Date</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        @if(session()->has('LoggedAdmin'))
                        @else
                        <th>Add Issue</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $row)


                    <tr>
                        <form action="{{ route('views.addissue')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $row->productCode }}">
                            <input type="hidden" name="name" value="{{ $row->productName }}">
                            <input type="hidden" name="loadingNo" value="{{ $row->loadingNo }}">
                            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="qty" value="{{ $row->quantity }}">
                            <input type="hidden" name="empid" value="@if(Session::has('LoggedEmployee')){{Session::get('LoggedEmployee')}}@endif">

                            <td>{{$row-> productCode }} </td>
                            <td>{{$row-> productName }} </td>
                            <td>{{$row-> expDate }} </td>
                            <td>{{$row-> quantity }} </td>
                            @if($row-> quantity == 0)
                            <input type="hidden" name="issueDetails" value="Empty">
                            <td><strong>Empty</strong></td>
                            @else
                            <input type="hidden" name="issueDetails" value="Expired">
                            <td><strong>Expired</strong></td>
                            @endif
                            @if(session()->has('LoggedAdmin'))
                            @else
                            <td><button type="submit" class="btn btn-warning btn-sm">Submit</button></td>
                            @endif
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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