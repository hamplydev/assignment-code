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
                        <th>Action</th>
                        <th>#</th>
                        <th>Code</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Joined Date</th>
                    </tr>
                </thead>
                <tbody>


            @if(isset($employees))
                @foreach($employees as $k=>$item)
            <tr >                        
                <td class="">
                    <div class="input-group-prepend">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -141px, 0px);">

                            <a class="dropdown-item" href=""> <i class="icon-edit"></i> View </a> 

                            <a class="dropdown-item" href="{{ route('employee.edit', $item->id) }}"> <i class="icon-edit"></i> Edit</a>

                            <a class="dropdown-item" href="" id="link_modal" data-toggle="modal" data-id="" data-target="#modal"> <i class="icon-trash"></i> Remove </a>

                        </div>
                    </div>

                </td>
  
                <td></td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->first_name." ".$item->last_name }}</td>
                <td>{{ (isset($item->gender) && $item->gender==1)? 'Male':'Female' }}</td>                  
                <td>{{ isset($item->department->name)? $item->department->name : '' }}</td>
                <td>{{ isset($item->position->name)? $item->position->name : '' }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->joined_date }}</td>
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