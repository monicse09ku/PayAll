@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if(isReseller())
            @include('components.reseller-boxes', ['fund' => $fund])
        @endif

        @if(isAdmin())
            @include('components.pending-topups', ['topups' => $topups])
        @endif

        @if(isAdmin())
            @include('components.update-topups', ['topups' => $topups])
        @endif


        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="bd-alert-box"></div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Bangladesh</h4>
                    </div>
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
            <!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="ind-alert-box"></div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">India</h4>
                    </div>
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
            <!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div id="pak-alert-box"></div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Pakistan</h4>
                    </div>
                <!-- /.box-header -->
                <!-- form start -->
                    <form role="form" id="test">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label>Operator</label>
                                <select class="form-control" id="pak-operator">
                                    <option value="">Select Operator</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="Telenor">Telenor</option>
                                    <option value="Zong">Zong</option>
                                    <option value="Ufone">Ufone</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="pak-number">Number</label>
                                <input type="text" class="form-control" id="pak-number" placeholder="Enter number">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="pak-amount">Amount</label>
                                <input type="text" class="form-control" id="pak-amount" placeholder="Enter amount">
                            </div>  
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary pak-amount-submit pull-right">Submit</button>
                            </div>                          
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('page_scripts')
<script type="text/javascript" defer>
    $(document).ready( function () {
        $('#example1').DataTable({
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

    $('.bd-amount-submit').click(function(e){
        e.preventDefault();
        
        if (confirm('Are you sure?')) {
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

            topUpAll(values);
        } else {
            // Do nothing!
        }

        
    
    })

    $('.ind-amount-submit').click(function(e){
        e.preventDefault();
        if (confirm('Are you sure?')) {
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

            topUpAll(values);
        } else {

        }
    
    })

    $('.pak-amount-submit').click(function(e){
        e.preventDefault();
        if (confirm('Are you sure?')) {
            var operator = $('#pak-operator').val();
            if(operator.length === 0){
                show_alert('alert-danger', 'Please select Operator.', '#pak-alert-box');
                $('#pak-operator').css('border', '1px solid red');
                return false;
            }else{
                $('#pak-operator').css('border', '1px solid green');
            }

            var number = $('#pak-number').val();
            if(number.length === 0){
                show_alert('alert-danger', 'Please provide number.', '#pak-alert-box');
                $('#pak-number').css('border', '1px solid red');
                return false;
            }else{
                $('#pak-number').css('border', '1px solid green');
            }

            var amount = $('#pak-amount').val();
            if(amount.length === 0){
                show_alert('alert-danger', 'Please provide amount.', '#pak-alert-box');
                $('#pak-amount').css('border', '1px solid red');
                return false;
            }else{
                $('#pak-amount').css('border', '1px solid green');
            }

            var values = {
                country: 'pak',
                operator: operator,
                payment_type: 'top_up',
                number: number,
                amount: amount,
                _token: "{{ csrf_token() }}",
            };

            topUpAll(values);
        } else {

        }
    
    })

    $('.update-topup-button').click(function(e){
        e.preventDefault();
        if (confirm('Are you sure?')) {
            var id = $('#topupId').val();
            var topup_user_id = $('#topupUserId').val();
            var topup_transaction_id = $('#transactionId').val();
            if(topup_transaction_id.length === 0){
                show_alert('alert-danger', 'Please provide topup transaction id.', '#alert-box');
                $('#transactionId').css('border', '1px solid red');
                return false;
            }else{
                $('#transactionId').css('border', '1px solid green');
            }

            
            var url = '<?php echo url('update-top-up');?>';

            var values = {
                id: id,
                topup_user_id: topup_user_id,
                topup_transaction_id: topup_transaction_id,
                _token: "{{ csrf_token() }}",
            };

            $.ajax({
                type: 'POST',
                url: url,
                data: values,
                success: function(result){
                    var response = result;
                    if(response.status === 'failed'){
                        show_alert('alert-danger', response.message, '#alert-box');
                    }else{
                        show_alert('alert-success', response.message, '#alert-box');
                        location.reload();
                    }
                    
                },
            });
        } else {

        }
    
    })

    function topUpAll(values){
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
                    
                    if(values.country === 'bd'){
                        show_alert('alert-danger', response.message, '#bd-alert-box');
                    }else if(values.country === 'ind'){
                        show_alert('alert-danger', response.message, '#ind-alert-box');
                    }else{
                        show_alert('alert-danger', response.message, '#pak-alert-box');
                    }
                }else{
                    if(values.country === 'bd'){
                        show_alert('alert-success', response.message, '#bd-alert-box');
                        $('#bd-operator').val('');
                        $('#bd-number').val('');
                        $('#bd-amount').val('');
                    }else if(values.country === 'ind'){
                        show_alert('alert-success', response.message, '#ind-alert-box');
                        $('#ind-type').val('');
                        $('#ind-operator').val('');
                        $('#ind-pradesh').val('');
                        $('#ind-number').val('');
                        $('#ind-provider').val('');
                        $('#ind-subscriber-id').val('');
                        $('#ind-amount').val('');
                    }else{
                        show_alert('alert-success', response.message, '#pak-alert-box');
                        $('#pak-operator').val('');
                        $('#pak-number').val('');
                        $('#pak-amount').val('');
                    }

                    location.reload();
                }
            },
        }); 
    }

    function editTopup(topup){
        $('#topupId').val(topup.id); 
        $('#topupUserId').val(topup.user_id); 
    }

    function deleteTopup(topup){
        console.log(topup);
        if (confirm('Are you sure to delete the topup request?')) {
            var url = '<?php echo url('delete-top-up');?>';

            var values = {
                topup: topup,
                _token: "{{ csrf_token() }}",
            };

            $.ajax({
                type: 'POST',
                url: url,
                data: values,
                success: function(result){
                    var response = result;
                    alert(response.message);
                    if(response.status === 'success'){
                        location.reload();
                    }
                    
                },
            });
        } else {

        }
    }
</script>
  
@endsection
