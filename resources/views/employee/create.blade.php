@extends('layout.master')


@push('styles')
<link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">



<style>
.similar_name{
        background-color: #DFDFDF;
        width: 217px;
        padding: 1px;
        margin-top: 2px;
        border-radius: 1%;  
    }


    .image-holder{
        margin-top: 10px;
        height: 200px;

    }

    .image-holder img{
      max-height: 100%;
    }

    #image-holder_one{
        background-color: gray;
    }

    .imageThumb {
      max-height: 75px;
      border: 2px solid;
      padding: 1px;
      cursor: pointer;
    }

    .pip {
      /*display: inline-block;*/
      margin: 10px 10px 0 0;
    }
    .remove {
      display: block;
      background: #444;
      border: 1px solid black;
      color: white;
      text-align: center;
      cursor: pointer;
    }
    .remove:hover {
      background: white;
      color: black;
    }

    .input_r{
        color:#FF0000;
        font-weight: bold;
    }

</style>
@endpush


@section('content')

@php
if(isset($employee)){
    $title      = "Edit Employee Data";
    $sub_nav    = "Edit";
}else{
    $title      = "New Employee";
    $sub_nav    = "New";
} 
@endphp

<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
            <li class="breadcrumb-item active">{{ $sub_nav }}</li>
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

    <!-- <iframe name="ifrmVehicleSave" id="ifrmVehicleSave" width="100%" style="display:none;"></iframe>
<form target="ifrmVehicleSave" autocomplete="off" role="form" id="form" action="{{ route('employee.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data"> -->

@if (isset($employee))
    <form role="form" id="form" action="{{ route('employee.update', $employee->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form role="form" id="form" action="{{ route('employee.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
@endif


    <div style="margin-left: 15px;">    
        <input type="hidden" name="id" id="id" value="#">
        <button type="submit" class="btn btn-primary">Submit</button>  
        @if (isset($employee)) 
            <a class="btn btn-secondary" href="{{ route('employee.index') }}"> Go Back </a>   
        @endif
    </div>

    <!-- <div id="alert" style="display:none;" class="alert alert-error"></div> -->

    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_basicinfo">Basic Info</a></li>        
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_work">Work</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_additional">Additional Info</a></li>
        </ul>

        <div class="tab-content" style="margin-bottom: 20px;">
            <div id="tab_basicinfo" class="tab-pane active"><br>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('employee.partials.form-basic')
                        </div>
                    </div>
                </div>
            </div>
            

            <div id="tab_work" class="tab-pane fade"><br>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('employee.partials.form-work')
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab_additional" class="tab-pane fade"><br>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('employee.partials.form-additional')
                        </div>
                    </div>
                </div>
            </div>
     
        </div>



</form>


  </div>
</div>

@endsection



@push('scripts')

<script src="{{ asset('vendors/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendors/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


<script>

$(function () {
    
    //Date picker
    $('#date_of_birth').datetimepicker({
        //format: 'L'
        format:'DD/MM/YYYY'
    });

    
    //Date picker
    $('#joined_date').datetimepicker({
        //format: 'L'
        format:'DD/MM/YYYY'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Timepicker
    $('#working_start_time').datetimepicker({
      format: 'LT'
    })

    //Timepicker
    $('#working_end_time').datetimepicker({
      format: 'LT'
    })



    document.getElementById('department_id').disabled = false;
    $('#department_id').change(function(){

        $('form').bind('submit',function(e){e.preventDefault();});
        $('form button, form input, form select').prop('disabled', true);
        $('.loading').remove();

        $(this).after('<span class="loading"></span>');
        var _self = $(this);
        var dept_id = $(this).val();

        var url = '{{ route("employee.position", ":id") }}';
        url = url.replace(':id', dept_id);

        /*$.get("/asset-item/load-item-by-category",
            {dept_id: dept_id}
            ,function(data,status){
                $('form').unbind('submit');
                $('form button, form input, form select').prop('disabled', false);

                var obj = $.parseJSON( data );

                $('#position_id').find('option:not(:first)').remove();
                for (var i = 0; i < obj.length; i++) {
                    $('#position_id').append('<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>');
                }

                $('.loading').remove();
            });*/

        $('#position_id').find('option:not(:first)').remove();
        $.ajax({
           // url: 'get-position/'+dept_id,
           url: url,
           type: 'get',
           dataType: 'json',
           success: function(response){
                $('form').unbind('submit');
                $('form button, form input, form select').prop('disabled', false);

             var len = 0;
             if(response['data'] != null){
                len = response['data'].length;
             }

             if(len > 0){
                // alert(JSON.stringify(response['data']));
                // Read data and create <option >
                
                for (var i = 0; i<len; i++) {
                    var id = response['data'][i].id;
                    var name = response['data'][i].name;
                    $('#position_id').append('<option value="'+id+'">'+name+'</option>');
                }

                $('.loading').remove();

             }


           },
           error: function(response){
                $('form').unbind('submit');
                $('form button, form input, form select').prop('disabled', false);
           }

         });


    }); 


});

</script>

@endpush