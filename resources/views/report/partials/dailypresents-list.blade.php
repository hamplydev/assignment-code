<div class="box">
    <div class="box-body"> 
        <!-- <div class="row" style="">       
            <div class="col-md-6">
                <a href="/asset-item/item-create" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div> -->

        <div class="row" style="">     
        <!-- /.Notification Box -->
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                </thead>
                <tbody>


            @if(isset($attendances))
                @foreach($attendances as $k=>$item)
            <tr >                        

  
                <td></td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->first_name." ".$item->last_name }}</td>                                 
                <td>{{ isset($item->department)? $item->department : '' }}</td>
                <td>{{ isset($item->position)? $item->position : '' }}</td>
                <td>{{ isset($item->date)? $item->date : '' }}</td>
                <td>{{ $item->checkin }}</td>
                <td>{{ $item->checkout }}</td>
            </tr>
            @endforeach
            @endif
                                                
                </tbody>
            </table>
        </div>
        </div>

    </div>
    <!-- /.box-body -->
</div>


<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Record:</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">
              <p>Are you sure to remove this record? &hellip; <label id="code"></label></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="btn-cb-del">Yes</button>
              <!-- <button type="button" class="btn btn-danger">Pemantly Delete</button> -->
            </div>
        </div>
    </div>
</div>