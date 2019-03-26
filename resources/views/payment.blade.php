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
                    Payments
                    <!-- <small>advanced tables</small> -->
                    <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#myModal" onclick="addPayment()">
                      Add New Payment
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
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>MR/MM</th>
                                            <th>Memo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        <tr class="reseller-rows">
                                            <td>{{ $payment->created_at }}</td>
                                            <td>{{ $payment->from_user }}</td>
                                            <td>{{ $payment->to_user }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->fund_type }}</td>
                                            <td>{{ $payment->type }}</td>
                                            <td>{{ $payment->description }}</td>
                                            <td>
                                                @if(\Auth::user()->role == 'admin' || \Auth::user()->role == 'superadmin')
                                                <button data-toggle="modal" data-target="#myModal" onclick="editPayment({{ $payment }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button onclick="deletePayment({{ $payment }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">Add New Payment</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="alert-box"></div>
                <!-- /.box-header -->
                <!-- form start -->
                    <form role="form" id="test">
                        <div class="box-body">
                            <input type="hidden" class="form-control" id="paymentId" value="">
                            <div class="form-group col-md-6">
                                <label>User</label>
                                <select class="form-control" id="userId">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fund Type</label>
                                <select class="form-control" id="fundType">
                                    <option value="">Select Fund Type</option>
                                    @foreach(provideFundType() as $fund_type)
                                    <option value="{{ $fund_type }}">{{ $fund_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Add / Return</label>
                                <select class="form-control" id="type">
                                    <option value="">Select</option>
                                    <option value="add_fund">Add Fund</option>
                                    <option value="return">Return</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="paymentAmount">Amount</label>
                                <input type="text" class="form-control" id="paymentAmount" placeholder="Enter amount">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pin">Pin</label>
                                <input type="text" class="form-control" id="pin" placeholder="Enter pin" value="<?php if(\Auth::user()->role == 'admin') { echo rand(10000, 99999); }?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="paymentDescription">Description</label>
                                <textarea class="form-control" id="paymentDescription" placeholder="Enter Description"></textarea>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary save-payment-button pull-right">Save Payment Data</button>
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

    function addPayment(){
        $('.modal-title').html('Add New Payment');
        $('#userId').val('');
        $('#fundType').val('');
        $('#type').val();
        $('#paymentAmount').val();
        $('#pin').val('');
        $('#paymentDescription').val('');
    }

    $('.save-payment-button').click(function(e){
        e.preventDefault();
        var url = '<?php echo url('payments');?>';
        var payment_id = $('#paymentId').val();

        var user_id = $('#userId').val();
        if(user_id.length === 0){
            show_alert('alert-danger', 'Please select user.');
            $('#userId').css('border', '1px solid red');
            return false;
        }else{
            var user_name = $('#userId option:selected').text();
            $('#userId').css('border', '1px solid green');
        }

        var fund_type = $('#fundType').val();
        if(fund_type.length === 0){
            show_alert('alert-danger', 'Please select Fubd Type.');
            $('#fundType').css('border', '1px solid red');
            return false;
        }else{
            $('#fundType').css('border', '1px solid green');
        }

        var type = $('#type').val();
        if(type.length === 0){
            show_alert('alert-danger', 'Please select type.');
            $('#type').css('border', '1px solid red');
            return false;
        }else{
            $('#type').css('border', '1px solid green');
        }

        var amount = $('#paymentAmount').val();
        if(amount.length === 0){
            show_alert('alert-danger', 'Please provide pin.');
            $('#paymentAmount').css('border', '1px solid red');
            return false;
        }else{
            $('#paymentAmount').css('border', '1px solid green');
        }

        var pin = $('#pin').val();
        if(pin.length === 0){
            show_alert('alert-danger', 'Please provide pin.');
            $('#resellerPin').css('border', '1px solid red');
            return false;
        }else{
            $('#resellerPin').css('border', '1px solid green');
        }

        var payment_description = $('#paymentDescription').val();
        if(payment_description.length === 0){
            show_alert('alert-danger', 'Please provide description.');
            $('#paymentDescription').css('border', '1px solid red');
            return false;
        }else{
            $('#paymentDescription').css('border', '1px solid green');
        }

        if(payment_id.length === 0){
            var values = {
                user_id: user_id,
                user_name: user_name,
                fund_type: fund_type,
                type: type,
                amount: amount,
                pin: pin,
                payment_description: payment_description,
                _token: "{{ csrf_token() }}",
            };
        }else{
            var values = {
                id: payment_id,
                user_id: user_id,
                user_name: user_name,
                fund_type: fund_type,
                type: type,
                amount: amount,
                pin: pin,
                payment_description: payment_description,
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
                    $('#userId').val('');
                    $('#fundType').val('');
                    $('#type').val();
                    $('#paymentAmount').val();
                    $('#pin').val('');
                    $('#paymentDescription').val('');
                    location.reload();
                }
            },
        }); 
    })

    function editPayment(payment) {
        $('.modal-title').html('Edit Payment');
        $('#paymentId').val(payment.id);
        $('#userId').val(payment.user_id);
        $('#fundType').val(payment.fund_type);
        $('#type').val(payment.type);
        $('#paymentAmount').val(payment.amount);
        $('#paymentDescription').val(payment.description);
    }

    function deletePayment(payment) {
        var result = confirm("Want to delete?");
        if (result) {
            var url = '<?php echo url('payments');?>' + '/' + payment.id;
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
