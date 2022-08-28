@extends('layout.master')

@section('content')

<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Department</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Department</a></li>
            <li class="breadcrumb-item active">New</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<!-- /.content-header -->

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


<div class="content">
  <div class="container-fluid">

    <div class="page-body">


    @if (isset($department))
        <form role="form" id="form" action="{{ route('department.update', $department->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    @else
        <form role="form" id="form" action="{{ route('department.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
    @endif

        @if (isset($department))
            <legend style="color:red;">Edit Data</legend>
        @else
            <legend style="color:red;">Add New Data</legend>
        @endif
        <hr />
        <div class="row"> 
            <input type="hidden"  name="id" id="id" value="#">
            <div class="col-md-4"> 
                <div class="form-group">
                    <label for="name">Department Name </label>
                    <input type="text" class="form-control" id="name" name="name" required="required" value="{{ isset($department) ? $department->name : '' }}" placeholder="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ isset($department) ? $department->description : '' }}" placeholder="">
                </div>                                      
            </div>
            <div class="col-md-4">
                <!-- <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea class="form-control" id="remark" name="remark" rows="5">#</textarea>
                </div> -->
                
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-4">  
            <div class="form-group">                   
                <!-- <button type="button" id="submit_btn" class="btn btn-primary ">Submit</button> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-dark" href="{{ route('department.index') }}"><i class="icon-undo"></i> Back </a>
            </div>
            </div>
        </div>
    </form>
</div>

  </div>
</div>

@endsection