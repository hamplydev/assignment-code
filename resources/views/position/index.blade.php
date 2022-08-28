@extends('layout.master')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')


<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Position</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Position</a></li>
            <li class="breadcrumb-item active">List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<!-- /.content-header -->


<div class="content">
  <div class="container-fluid">

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-ban"></i> Alert!</h5>
      {{ session('error') }}
    </div>

    @elseif(session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      {{ session('success') }}
    </div>
    @endif

    <div class="panel panel-inverse" style="margin-left: 15px;">
      <p class="pull-left">
        <a class="btn btn-success" href="{{ route('position.create') }}"><i class="icon-plus"></i> Add New</a>  
        <a class="btn btn-info" href="#"> Excel </a>  
        <a class="btn btn-secondary" href="#"> CSV </a>
      </p>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">        
          <div class="scroll-table" style="overflow-x: auto;">
          <div class="table-responsive">
          <table class="table table-striped table-bordered" id="data-table">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Description</th>
                  <th>Action</th>                        
              </tr>
            </thead>
            <tbody>
              @foreach ($position as $item)
              <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $item->department->name }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->description }}</td>
                  <td style="width: 7%;">
                      <div class="dropdown">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                          Action
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('position.edit', $item->id) }}"><i class="fa fa-edit"></i> Edit </a>
                              <a class="dropdown-item" href="" id="link_modal" data-toggle="modal" data-id="{{ $item->id }}" data-attr="{{ route('position.destroy', $item->id) }}" data-target="#modal-sm"> <i class="fa fa-trash"></i> Remove </a>


                              <!-- <form method="POST" action="{{ route('position.destroy', $item->id) }}">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button type="submit" class="dropdown-item btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i> Delete</button>
                              </form>
                               -->

                              <!-- <form action="{{ route('position.destroy',$item->id) }}" method="POST" >
                                        <a href="{{ route('position.show', $item->id) }}" class="dropdown-item"><i class="fa fa-eye"></i> Show</a>
                                        <a href="{{ route('position.edit', $item->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                              </form> -->

                          </div>
                      </div>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          </div>
          </div>
        </div>
      </div>    
    </div>   
         
  </div>
</div>

<!-- Modal Message -->
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
              <p id="del-p">Are you sure to remove this record? &hellip; <label id="code"></label></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="btn-del-yes" data-token="{{ csrf_token() }}">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Message -->



@endsection


@push('scripts')

<script>
    $(document).ready(function () {
  
      $(document).on('click','#link_modal', function(){
       
        var id            = $(this).attr('data-id');
        var tr            = $(this).parent().parent().parent().parent();
        var tdRecords     = $(tr).children();
        var col2_catname  = $(tdRecords[1]).text();
        var href = $(this).attr('data-attr');

        //$('#modal-sm').modal('show');                   

        $('#btn-del-yes').click(function () {


          var token = $("meta[name='csrf-token']").attr("content");
          $.ajax({
            url: href, 
            type: 'DELETE',
            data: {
              _token: token,
                  id: id
            },
            success: function (data) {
                console.log('Success:', data);
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }

          });


          });

    });

});

</script>

@endpush

