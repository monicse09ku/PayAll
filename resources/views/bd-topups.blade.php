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
                    Bangladesh
                    <!-- <small>advanced tables</small> -->
                    <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#myModal" onclick="addTopup()">
                      Add New
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
                                            <th>Name</th>
                                            <th>Payment Type</th>
                                            <th>Number</th>
                                            <th>Amount</th>
                                            <th>Operator</th>
                                            <th>Status</th>
                                            <th>Create Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topups as $topup)
                                        <tr class="reseller-rows">
                                            <td>{{ $topup->user->name }}</td>
                                            <td>{{ $topup->type }}</td>
                                            <td>{{ $topup->number }}</td>
                                            <td>{{ $topup->amount }}</td>
                                            <td>{{ $topup->operator }}</td>
                                            <td>{{ $topup->status }}</td>
                                            <td>{{ $topup->created_at }}</td>
                                            
                                            <td>
                                                <!-- @if(\Auth::user()->role == 'admin' || \Auth::user()->role == 'superadmin')
                                                <button data-toggle="modal" data-target="#myModal" onclick="editTopup({{ $topups }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button onclick="deleteTopup({{ $topups }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                @endif -->
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
                <h4 class="modal-title" id="myModalLabel">Add New</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="bd-alert-box"></div>
                <!-- /.box-header -->
                <!-- form start -->
                    <form role="form" id="test">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label>Type</label>
                                <select class="form-control" id="bd-operator">
                                    <option value="">Select Type</option>
                                    <option value="top_up">Top Up</option>
                                    <option value="bkash">BKash</option>
                                    <option value="rocket">Rocket</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bd-number">Number</label>
                                <input type="text" class="form-control" id="bd-number" placeholder="Enter number">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bd-amount">Amount</label>
                                <input type="text" class="form-control" id="bd-amount" placeholder="Enter amount">
                            </div>  
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary bd-amount-submit pull-right">Submit</button>
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
        
        });
    } );

    function addTopup(){
        $('.modal-title').html('Add New');
        $('#bd-operator').val('');
        $('#bd-number').val('');
        $('#bd-amount').val('');
    }

    $('.bd-amount-submit').click(function(e){
        e.preventDefault();
        
        var payment_type = $('#bd-operator').val();
        if(payment_type.length === 0){
            show_alert('alert-danger', 'Please select Operator.', '#bd-alert-box');
            $('#bd-operator').css('border', '1px solid red');
            return false;
        }else{
            $('#bd-operator').css('border', '1px solid green');
        }

        var number = $('#bd-number').val();
        if(number.length === 0){
            show_alert('alert-danger', 'Please provide number.', '#bd-alert-box');
            $('#bd-number').css('border', '1px solid red');
            return false;
        }else{
            $('#bd-number').css('border', '1px solid green');
        }

        var amount = $('#bd-amount').val();
        if(amount.length === 0){
            show_alert('alert-danger', 'Please provide amount.', '#bd-alert-box');
            $('#bd-amount').css('border', '1px solid red');
            return false;
        }else{
            $('#bd-amount').css('border', '1px solid green');
        }


        var values = {
            country: 'bd',
            payment_type: payment_type,
            number: number,
            amount: amount,
            _token: "{{ csrf_token() }}",
        };

        var url = '<?php echo url('create-top-up');?>';
        //console.log(values);return;
        $.ajax({
            type: 'POST',
            url: url,
            data: values,
            success: function(result){
                var response = result;
                console.log(response);
                if(response.status === 'failed'){
                    
                    show_alert('alert-danger', response.message, '#bd-alert-box');
                }else{
                    show_alert('alert-success', response.message, '#bd-alert-box');
                    $('#bd-operator').val('');
                    $('#bd-number').val('');
                    $('#bd-amount').val('');

                    location.reload();
                }
            },
        }); 
    
    })

    function editTopup(reseller) {
        $('.modal-title').html('Edit Reseller');
        $('#resellerId').val(reseller.id);
        $('#resellerName').val(reseller.name);
        $('#resellerEmail').val(reseller.email);
        $('#resellerPassword').val('');
        $('#resellerPin').val(reseller.reseller.pin);
        $('#resellerStatus').val(reseller.status);
        $('#resellerRole').val(reseller.role);
    }

    function deleteTopup(reseller) {
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
