<!DOCTYPE html>
<html lang="en">

<head>
    @include('employee_partials.empmain')
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
        <h3 style="color: blue; text-align: center;">Pending Issue</h3>
        <p>Please Fix all Issue then marked as Solved.</p>
        <div class="col-sm-9">
            <table id="datatable" class="table table-bordered yajra-datatable">
                <thead>
                    <tr class="table-head">
                        <th>P. Code</th>
                        <th>Product Name</th>
                        <th>L. No</th>
                        <th>Issue Date</th>
                        <th>Reason</th>
                        <th>Quantity</th>
                        <th>Emp. Id</th>
                        <th>Status</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $row)
                    <tr>

                        <form action="{{ route('views.solveissue')}}" method="post">
                            @csrf
                            <input type="hidden" name="issueCode" value="{{ $row->issueCode }}">
                            <td>{{$row-> productCode }} </td>
                            <td>{{$row-> productName }} </td>
                            <td>{{$row-> loadingNo }} </td>
                            <td>{{$row-> date }} </td>
                            <td>{{$row-> issueDetails }} </td>
                            <td>{{$row-> quantity }} </td>
                            <td>{{$row-> empid }} </td>
                            <td>Pending</td>
                            <td><button type="submit" class="btn btn-success btn-sm">Solved</button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- <div>
                {{csrf_field()}}
                <span id="form_output"></span>
            </div> -->

        </div>



        <!-- Right Side###############################################################  -->


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