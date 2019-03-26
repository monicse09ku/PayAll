@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Content Wrapper. Contains page content -->
        <div>
            <!-- Content Header (Page header) -->
            <section class="content-header" style="margin-bottom: 10px">
                <h1>
                    Resellers
                    <!-- <small>advanced tables</small> -->
                    <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#myModal" onclick="addReseller()">
                      Add New Reseller
                    </button>
                </h1>
                
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-18">
                        
                        <!-- /.box -->
                        <div class="box">
                            <!-- <div class="box-header">
                                <h3 class="box-title">Data Table With Full Features</h3>
                            </div> -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th hidden>User Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Parent User</th>
                                            <th>Bal-MR</th>
                                            <th>Bal-MM</th>
                                            <th>INR</th>
                                            <th>NRP</th>
                                            <th>Status</th>
                                            <th>Create Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($resellers as $reseller)
                                        <tr class="reseller-rows">
                                            <td hidden>{{ $reseller->id }}</td>
                                            <td>{{ $reseller->name }}</td>
                                            <td>{{ $reseller->email }}</td>
                                            <td>{{ !empty($reseller->reseller->parent_user) ? $reseller->reseller->parent_user : '' }}</td>
                                            <td>{{ !empty($reseller->fund->bal_mr) ? $reseller->fund->bal_mr : 0 }}</td>
                                            <td>{{ !empty($reseller->fund->bal_mm) ? $reseller->fund->bal_mm : 0 }}</td>
                                            <td>{{ !empty($reseller->fund->ind_rp) ? $reseller->fund->ind_rp : 0 }}</td>
                                            <td>{{ !empty($reseller->fund->npl_rp) ? $reseller->fund->npl_rp : 0 }}</td>
                                            <td>{{ $reseller->status }}</td>
                                            <td>{{ $reseller->created_at }}</td>
                                            <td>
                                                @if(\Auth::user()->role == 'admin' || \Auth::user()->role == 'superadmin')
                                                <button data-toggle="modal" data-target="#myModal" onclick="editReseller({{ $reseller }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button onclick="deleteReseller({{ $reseller }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                @endif
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>

        
    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Reseller</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="alert-box"></div>
                <!-- /.box-header -->
                <!-- form start -->
                    <form role="form" id="test">
                        <div class="box-body">
                            <input type="hidden" class="form-control" id="resellerId" placeholder="Enter Full Name" value="">
                            <div class="form-group col-md-6">
                                <label for="resellerName">Name</label>
                                <input type="text" class="form-control" id="resellerName" placeholder="Enter Full Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="resellerEmail">Email address</label>
                                <input type="email" class="form-control" id="resellerEmail" placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="resellerPassword">Password</label>
                                <input type="text" class="form-control" id="resellerPassword" placeholder="Password">
                                <i class="fa fa-retweet" aria-hidden="true" onclick="regenaratePassword()"></i>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="resellerPin">Pin</label>
                                <input type="text" class="form-control" id="resellerPin" placeholder="Pin">
                                <i class="fa fa-retweet" aria-hidden="true" onclick="regenaratePin()"></i>
                            </div>
                            <!-- select -->
                            @if(\Auth::user()->role == 'admin' || \Auth::user()->role == 'superadmin')
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <select class="form-control" id="resellerStatus">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Role</label>
                                <select class="form-control" id="resellerRole">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="reseller">Reseller</option>
                                </select>
                            </div>
                            @endif
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary save-reseller-button pull-right">Save Reseller Data</button>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_scripts')
<script type="text/javascript" defer>
    $(document).ready( function () {        

        $('#example1').DataTable({
            //"pageLength": 10
            /*'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false*/
        });
    } );

    function addReseller(){
        $('.modal-title').html('Add New Reseller');
        $('#resellerName').val('');
        $('#resellerEmail').val('');
        $('#resellerPassword').val(generatePassword());
        $('#resellerPin').val(generatePin());
        $('#resellerStatus').val('');
        $('#resellerRole').val('');
    }

    function regenaratePassword() {
        $('#resellerPassword').val(generatePassword());                    
    }

    function regenaratePin() {
        $('#resellerPin').val(generatePin());                    
    }

    function generatePassword() {
        var length = 12,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

    function generatePin() {
        var length = 5,
            charset = "0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

    $('.save-reseller-button').click(function(e){
        e.preventDefault();
        var url = '<?php echo url('resellers');?>';
        var reseller_id = $('#resellerId').val();

        var username = $('#resellerName').val();
        if(username.length === 0){
            show_alert('alert-danger', 'Please provide name.');
            $('#resellerName').css('border', '1px solid red');
            return false;
        }else{
            $('#resellerName').css('border', '1px solid green');
        }

        var email = $('#resellerEmail').val();
        if(email.length === 0){
            if(check_valid_email(email) === false)
            show_alert('alert-danger', 'Please provide email.');
            $('#resellerEmail').css('border', '1px solid red');
            return false;
        }else{
            $('#resellerEmail').css('border', '1px solid green');
        }

        var password = $('#resellerPassword').val();
        if(password.length === 0 && reseller_id.length === 0){
            show_alert('alert-danger', 'Please provide password.');
            $('#resellerPassword').css('border', '1px solid red');
            return false;
        }else{
            $('#resellerPassword').css('border', '1px solid green');
        }

        var pin = $('#resellerPin').val();
        if(pin.length === 0){
            show_alert('alert-danger', 'Please provide pin.');
            $('#resellerPin').css('border', '1px solid red');
            return false;
        }else{
            $('#resellerPin').css('border', '1px solid green');
        }

        var status = $('#resellerStatus').val();
        var role = $('#resellerRole').val();

        if(reseller_id.length === 0){
            var values = {
                username: username,
                email: email,
                password: password,
                pin: pin,
                status: status,
                role: role,
                _token: "{{ csrf_token() }}",
            };
        }else{
            var values = {
                id: reseller_id,
                username: username,
                email: email,
                password: password,
                pin: pin,
                status: status,
                role: role,
                _token: "{{ csrf_token() }}",
            };
        }
        
        $.ajax({
            type: 'POST',
            url: url,
            data: values,
            success: function(result){
                var response = JSON.parse(result);
                if(response.status === 'failed'){
                    show_alert('alert-danger', response.message);
                }else{
                    show_alert('alert-success', response.message);
                    $('#resellerId').val('');
                    $('#resellerName').val('');
                    $('#resellerEmail').val('');
                    $('#resellerPassword').val(generatePassword());
                    $('#resellerPin').val(generatePin());
                    $('#resellerStatus').val('');
                    $('#resellerRole').val('');
                    location.reload();
                }
            },
        }); 
    })

    function editReseller(reseller) {
        $('.modal-title').html('Edit Reseller');
        $('#resellerId').val(reseller.id);
        $('#resellerName').val(reseller.name);
        $('#resellerEmail').val(reseller.email);
        $('#resellerPassword').val('');
        $('#resellerPin').val(reseller.reseller.pin);
        $('#resellerStatus').val(reseller.status);
        $('#resellerRole').val(reseller.role);
    }

    function deleteReseller(reseller) {
        var result = confirm("Want to delete?");
        if (result) {
            var url = '<?php echo url('resellers');?>' + '/' + reseller.id;
            $.ajax({
                type: "DELETE",
                url: url,
                data: {_token : "{{ csrf_token() }}"},
                success: function(result){
                    var response = JSON.parse(result);
                    if(response.status === 'failed'){
                        alert(response.message);
                    }else{
                        //alert(response.message);
                        location.reload();
                    }
                },
            });
        }
    }
</script>
  
@endsection
