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
                            <th>Country</th>
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
                            <td>{{ $topup->country }}</td>
                            <td>{{ $topup->operator }}</td>
                            <td>{{ $topup->status }}</td>
                            <td>{{ $topup->created_at }}</td>
                            
                            <td>
                                @if(\Auth::user()->role == 'admin' || \Auth::user()->role == 'superadmin')
                                <button data-toggle="modal" data-target="#myModal" onclick="editTopup({{ $topup }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button onclick="deleteTopup({{ $topup }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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