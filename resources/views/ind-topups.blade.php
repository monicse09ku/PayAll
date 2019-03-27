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
                                            <th>Pradesh</th>
                                            <th>Provider</th>
                                            <th>Subscriber Id</th>
                                            <th>Status</th>
                                            <th>Transaction Id</th>
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
                                            <td>{{ $topup->pradesh }}</td>
                                            <td>{{ $topup->provider }}</td>
                                            <td>{{ $topup->subscriber_id }}</td>
                                            <td>{{ $topup->status }}</td>
                                            <td>{{ $topup->topup_transaction_id }}</td>
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
                <h4 class="modal-title" id="myModalLabel">Add New Reseller</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="ind-alert-box"></div>
                <!-- /.box-header -->
                <!-- form start -->
                    <form role="form" id="test">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label>Type</label>
                                <select class="form-control" id="ind-type">
                                    <option value="">Select Type</option>
                                    <option value="top_up">Top Up</option>
                                    <option value="d2h">D2H</option>
                                </select>
                            </div>
                            <div id="india-top-up-fields" style="display: none">
                                <div class="form-group col-md-6">
                                    <label>Operator</label>
                                    <select class="form-control" id="ind-operator">
                                        <option value="">Select Operator</option>
                                        <option value="AIRTEL">AIRTEL</option>
                                        <option value="AIRCEL">AIRCEL</option>
                                        <option value="BSNL">BSNL</option>
                                        <option value="VODAFONE">VODAFONE</option>
                                        <option value="IDEA">IDEA</option>
                                        <option value="TATADOCOMO">TATA DOCOMO</option>
                                        <option value="TATAINDICOM">TATA INDICOM</option>
                                        <option value="RELIANCEGSM">RELIANCE GSM</option>
                                        <option value="RELIANCECDMA">RELIANCE CDMA</option>
                                        <option value="RELIANCEJIO">RELIANCE JIO</option>
                                        <option value="MTS">MTS</option>
                                        <option value="UNINOR">UNINOR</option>
                                        <option value="LOOP MOBILE">LOOP MOBILE</option>
                                        <option value="VIDEOCON">VIDEOCON</option>
                                        <option value="MTNL">MTNL</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pradesh</label>
                                    <select class="form-control" id="ind-pradesh">
                                        <option value="">Select Pradesh</option>
                                        <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                        <option value="ASSAM">ASSAM</option>
                                        <option value="BIHAR">BIHAR &amp; JHARKHAND</option>
                                        <option value="CHENNAI">CHENNAI</option>
                                        <option value="DELHI">DELHI</option>
                                        <option value="GUJRAT">GUJRAT</option>
                                        <option value="HARYANA">HARYANA</option>
                                        <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                        <option value="JAMMU &amp; KASHMIR">JAMMU &amp; KASHMIR</option>
                                        <option value="KARNATAKA">KARNATAKA</option>
                                        <option value="KERALA">KERALA</option>
                                        <option value="KOLKATA">KOLKATA</option>
                                        <option value="MUMBAI">MUMBAI</option>
                                        <option value="NORTH EAST">NORTH EAST</option>
                                        <option value="ORISSA">ORISSA</option>
                                        <option value="PUNJAB">PUNJAB</option>
                                        <option value="RAJASTHAN">RAJASTHAN</option>
                                        <option value="TAMILNADU">TAMIL NADU</option>
                                        <option value="UTTAR PRADESH(EAST)">UTTAR PRADESH(EAST)</option>
                                        <option value="UTTAR PRADESH(WEST)">UTTAR PRADESH(WEST)</option>
                                        <option value="WEST BENGAL">WEST BENGAL</option>
                                        <option value="MAHARASHTRA">MAHARASHTRA</option>
                                        <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                    </select>
                                </div>
                            
                                <div class="form-group col-md-12">
                                    <label for="ind-number">Number</label>
                                    <input type="text" class="form-control" id="ind-number" placeholder="Enter number">
                                </div>
                            </div>
                            <div id="india-d2h-fields"  style="display: none">
                                <div class="form-group col-md-12">
                                    <label>Provider</label>
                                    <select class="form-control" id="ind-provider">
                                        <option value="">Select Provider</option>
                                        <option value="AIRTEL DTH">AIRTEL DTH</option>
                                        <option value="SUN DIRECT DTH">SUN DIRECT DTH</option>
                                        <option value="TATA SKY">TATA SKY</option>
                                        <option value="DISH TV">DISH TV</option>
                                        <option value="RELIANCE BIG TV">RELIANCE BIG TV</option>
                                        <option value="VIDEOCON D2H">VIDEOCON D2H</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ind-subscriber-id">Subscriber ID</label>
                                    <input type="text" class="form-control" id="ind-subscriber-id" placeholder="Enter Subscriber ID">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="ind-amount">Amount</label>
                                <input type="text" class="form-control" id="ind-amount" placeholder="Enter number">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary ind-amount-submit pull-right">Submit</button>
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

    $('#ind-type').on('change', function() {
        var payment_type = $('#ind-type').val();

        if(payment_type === 'top_up'){
            $('#india-d2h-fields').css( "display", "none" ) ;
            $('#india-top-up-fields').css( "display", "block" ) ;
        }else{
            $('#india-d2h-fields').css( "display", "block" ) ;
            $('#india-top-up-fields').css( "display", "none" ) ;
        }
    });

    function addTopup(){
        $('.modal-title').html('Add New');
        $('#ind-type').val('');
        $('#ind-operator').val('');
        $('#ind-pradesh').val('');
        $('#ind-number').val('');
        $('#ind-provider').val('');
        $('#ind-subscriber-id').val('');
        $('#ind-amount').val('');
    }

    $('.ind-amount-submit').click(function(e){
        e.preventDefault();
        
        var payment_type = $('#ind-type').val();
        if(payment_type.length === 0){
            show_alert('alert-danger', 'Please select Type.', '#ind-alert-box');
            $('#ind-type').css('border', '1px solid red');
            return false;
        }else{
            $('#ind-type').css('border', '1px solid green');
        }

        if(payment_type === 'top_up'){
            var operator = $('#ind-operator').val();
            if(operator.length === 0){
                show_alert('alert-danger', 'Please select operator.', '#ind-alert-box');
                $('#ind-operator').css('border', '1px solid red');
                return false;
            }else{
                $('#ind-operator').css('border', '1px solid green');
            }

            var pradesh = $('#ind-pradesh').val();
            if(pradesh.length === 0){
                show_alert('alert-danger', 'Please select pradesh.', '#ind-alert-box');
                $('#ind-pradesh').css('border', '1px solid red');
                return false;
            }else{
                $('#ind-pradesh').css('border', '1px solid green');
            }

            var number = $('#ind-number').val();
            if(number.length === 0){
                show_alert('alert-danger', 'Please provide number.', '#ind-alert-box');
                $('#ind-number').css('border', '1px solid red');
                return false;
            }else{
                $('#ind-number').css('border', '1px solid green');
            }
        }else{
            var provider = $('#ind-provider').val();
            if(provider.length === 0){
                show_alert('alert-danger', 'Please select provider.', '#ind-alert-box');
                $('#ind-provider').css('border', '1px solid red');
                return false;
            }else{
                $('#ind-provider').css('border', '1px solid green');
            }

            var subscriber_id = $('#ind-subscriber-id').val();
            if(subscriber_id.length === 0){
                show_alert('alert-danger', 'Please provide subscriber.', '#ind-alert-box');
                $('#ind-subscriber-id').css('border', '1px solid red');
                return false;
            }else{
                $('#ind-subscriber-id').css('border', '1px solid green');
            }
        }

        var amount = $('#ind-amount').val();
        if(amount.length === 0){
            show_alert('alert-danger', 'Please provide amount.', '#ind-alert-box');
            $('#ind-amount').css('border', '1px solid red');
            return false;
        }else{
            $('#ind-amount').css('border', '1px solid green');
        }

        if(payment_type === 'top_up'){
            var values = {
                country: 'ind',
                payment_type: payment_type,
                operator: operator,
                pradesh: pradesh,
                number: number,
                amount: amount,
                _token: "{{ csrf_token() }}",
            };
        }else{
            var values = {
                country: 'ind',
                payment_type: payment_type,
                provider: provider,
                subscriber_id: subscriber_id,
                amount: amount,
                _token: "{{ csrf_token() }}",
            };
        }

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
                    
                    show_alert('alert-danger', response.message, '#ind-alert-box');
                }else{
                    show_alert('alert-success', response.message, '#ind-alert-box');
                    $('#ind-type').val('');
                    $('#ind-operator').val('');
                    $('#ind-pradesh').val('');
                    $('#ind-number').val('');
                    $('#ind-provider').val('');
                    $('#ind-subscriber-id').val('');
                    $('#ind-amount').val('');

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
