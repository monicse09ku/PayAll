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
                            <input type="hidden" class="form-control" id="topupId" value="">
                            <input type="hidden" class="form-control" id="topupUserId" value="">
                        
                            <div class="form-group col-md-12">
                                <label for="transactionId">Transaction Id</label>
                                <input type="text" class="form-control" id="transactionId" placeholder="Enter Transaction Id">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary update-topup-button pull-right">Approve Top up</button>
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