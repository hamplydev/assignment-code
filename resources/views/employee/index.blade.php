@extends('layout.master')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Date & Time Picker -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

@endpush

@section('content')

<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Employee</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
            <li class="breadcrumb-item active">List</li>
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


<!-- <div class="box collapsed-box"> -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Search Form</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button> -->
        </div>
    </div>
    <!-- <div class="box-body" style="display: none;"> -->
    <div class="box-body">
        @include('employee.partials.list-search')
    </div>
</div>


<!-- Table : Employee -->
@include('employee.partials.list')






<style>
    .add_new {
        background: #00BA8B;
        width: 100px;
        height: 30px;
        border: unset;
        font-family: "SF Pro Text","SF Pro Icons","Helvetica Neue","Helvetica","Arial","Content-Bold",sans-serif !important;
        border-radius: 5px;
    }



        span {
        font-family: "SF Pro Text","SF Pro Icons","Helvetica Neue","Helvetica","Arial","Content-Bold",sans-serif !important;
        white-space: nowrap;
    }

    span:after {
        text-align: left;
        white-space: normal;
    }

    span:focus {
        outline: none;
    }


    .span{
        float: left;
        margin-right: 15px;
    }

    .btn-group.open .dropdown-menu {
        width: 57% !important;
    }

    .table > tbody > tr > td{
        vertical-align: middle;
    }

    .table td img {
        width: 80px;
        height: 80px;
        border-radius: 0;
    }

    .table {
        margin-top: 20px;
    }

    .btn{
        margin:0;
    }

    .table > thead > tr > th{
        text-align: center;
        vertical-align: middle;
        /*color: #FFFF00;*/
        color: #000000;
        background-color: #CFDFF0;
    }

     .table > thead > tr > th > span{
        color: #000000;
     }

/*
 * Component: Box
 * --------------
 */
.box {
  position: relative;
  border-radius: 3px;
  background: #ffffff;
  border-top: 2px solid #dee2e6;
  /*margin-bottom: 20px;*/
  width: 100%;
  /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);*/
}
.box.box-primary {
  border-top-color: #3c8dbc;
}
.box.box-info {
  border-top-color: #00c0ef;
}
.box.box-danger {
  border-top-color: #dd4b39;
}
.box.box-warning {
  border-top-color: #f39c12;
}
.box.box-success {
  border-top-color: #00a65a;
}
.box.box-default {
  border-top-color: #dee2e6;
}
.box.collapsed-box .box-body,
.box.collapsed-box .box-footer {
  display: none;
}
.box .nav-stacked > li {
  border-bottom: 1px solid #f4f4f4;
  margin: 0;
}
.box .nav-stacked > li:last-of-type {
  border-bottom: none;
}
.box.height-control .box-body {
  max-height: 300px;
  overflow: auto;
}
.box .border-right {
  border-right: 1px solid #f4f4f4;
}
.box .border-left {
  border-left: 1px solid #f4f4f4;
}
.box.box-solid {
  border-top: 0;
}
.box.box-solid > .box-header .btn.btn-default {
  background: transparent;
}
.box.box-solid > .box-header .btn:hover,
.box.box-solid > .box-header a:hover {
  background: rgba(0, 0, 0, 0.1);
}
.box.box-solid.box-default {
  border: 1px solid #d2d6de;
}
.box.box-solid.box-default > .box-header {
  color: #444444;
  background: #d2d6de;
  background-color: #d2d6de;
}
.box.box-solid.box-default > .box-header a,
.box.box-solid.box-default > .box-header .btn {
  color: #444444;
}
.box.box-solid.box-primary {
  border: 1px solid #3c8dbc;
}
.box.box-solid.box-primary > .box-header {
  color: #ffffff;
  background: #3c8dbc;
  background-color: #3c8dbc;
}
.box.box-solid.box-primary > .box-header a,
.box.box-solid.box-primary > .box-header .btn {
  color: #ffffff;
}
.box.box-solid.box-info {
  border: 1px solid #00c0ef;
}
.box.box-solid.box-info > .box-header {
  color: #ffffff;
  background: #00c0ef;
  background-color: #00c0ef;
}
.box.box-solid.box-info > .box-header a,
.box.box-solid.box-info > .box-header .btn {
  color: #ffffff;
}
.box.box-solid.box-danger {
  border: 1px solid #dd4b39;
}
.box.box-solid.box-danger > .box-header {
  color: #ffffff;
  background: #dd4b39;
  background-color: #dd4b39;
}
.box.box-solid.box-danger > .box-header a,
.box.box-solid.box-danger > .box-header .btn {
  color: #ffffff;
}
.box.box-solid.box-warning {
  border: 1px solid #f39c12;
}
.box.box-solid.box-warning > .box-header {
  color: #ffffff;
  background: #f39c12;
  background-color: #f39c12;
}
.box.box-solid.box-warning > .box-header a,
.box.box-solid.box-warning > .box-header .btn {
  color: #ffffff;
}
.box.box-solid.box-success {
  border: 1px solid #00a65a;
}
.box.box-solid.box-success > .box-header {
  color: #ffffff;
  background: #00a65a;
  background-color: #00a65a;
}
.box.box-solid.box-success > .box-header a,
.box.box-solid.box-success > .box-header .btn {
  color: #ffffff;
}
.box.box-solid > .box-header > .box-tools .btn {
  border: 0;
  box-shadow: none;
}
.box.box-solid[class*='bg'] > .box-header {
  color: #fff;
}
.box .box-group > .box {
  margin-bottom: 5px;
}
.box .knob-label {
  text-align: center;
  color: #333;
  font-weight: 100;
  font-size: 12px;
  margin-bottom: 0.3em;
}
.box > .overlay,
.overlay-wrapper > .overlay,
.box > .loading-img,
.overlay-wrapper > .loading-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.box .overlay,
.overlay-wrapper .overlay {
  z-index: 50;
  background: rgba(255, 255, 255, 0.7);
  border-radius: 3px;
}
.box .overlay > .fa,
.overlay-wrapper .overlay > .fa {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -15px;
  margin-top: -15px;
  color: #000;
  font-size: 30px;
}
.box .overlay.dark,
.overlay-wrapper .overlay.dark {
  background: rgba(0, 0, 0, 0.5);
}
.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
  content: " ";
  display: table;
}
.box-header:after,
.box-body:after,
.box-footer:after {
  clear: both;
}
.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
}
.box-header.with-border {
  border-bottom: 1px solid #f4f4f4;
}
.collapsed-box .box-header.with-border {
  border-bottom: none;
}
.box-header > .fa,
.box-header > .glyphicon,
.box-header > .ion,
.box-header .box-title {
  display: inline-block;
  font-size: 18px;
  margin: 0;
  line-height: 1;
}
.box-header > .fa,
.box-header > .glyphicon,
.box-header > .ion {
  margin-right: 5px;
}
.box-header > .box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}
.box-header > .box-tools [data-toggle="tooltip"] {
  position: relative;
}
.box-header > .box-tools.pull-right .dropdown-menu {
  right: 0;
  left: auto;
}
.box-header > .box-tools .dropdown-menu > li > a {
  color: #444!important;
}
.btn-box-tool {
  padding: 5px;
  font-size: 12px;
  background: transparent;
  color: #97a0b3;
}
.open .btn-box-tool,
.btn-box-tool:hover {
  color: #606c84;
}
.btn-box-tool.btn:active {
  box-shadow: none;
}
.box-body {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  padding: 10px;
}
.no-header .box-body {
  border-top-right-radius: 3px;
  border-top-left-radius: 3px;
}
.box-body > .table {
  margin-bottom: 0;
}
.box-body .fc {
  margin-top: 5px;
}
.box-body .full-width-chart {
  margin: -19px;
}
.box-body.no-padding .full-width-chart {
  margin: -9px;
}
.box-body .box-pane {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 3px;
}
.box-body .box-pane-right {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 0;
}
.box-footer {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-top: 1px solid #f4f4f4;
  padding: 10px;
  background-color: #ffffff;
}




</style>

@endsection

@push('scripts')

<!-- Date & Time Picker -->
<script src="{{ asset('vendors/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendors/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(document).ready(function () {


        $(document).on('click','#link_modal', function(){
            //alert("test");
            var id=$(this).attr('data-id');

            var tr = $(this).parent().parent().parent().parent();
            var tdRecords = $(tr).children();
            var col4 = $(tdRecords[3]).text();

            var c_code=$('#c_code').text();         

            $('#modal-sm').modal('show');
            $('#code').text(col4);                    

            $('#btn-cb-del').click(function () {
                var data = {
                    'id':id
                };
            });

        });


        // for search 

        // document.getElementById('category').disabled = false;
        $('#category').change(function(){

            $('form').bind('submit',function(e){e.preventDefault();});
            $('form button, form input, form select').prop('disabled', true);
            $('.loading').remove();

            $(this).after('<span class="loading"></span>');
            var _self = $(this);
            var category_id = $(this).val();
            $.get("/asset-item/load-item-by-category",
                {category_id: category_id}
                ,function(data,status){
                    $('form').unbind('submit');
                    $('form button, form input, form select').prop('disabled', false);

                    var obj = $.parseJSON( data );

                    $('#item_id').find('option:not(:first)').remove();
                    for (var i = 0; i < obj.length; i++) {
                        $('#item_id').append('<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>');
                    }

                    $('.loading').remove();
                });
        });


        // --------------- Search Section --------------------------------
        //Date picker
        $('#from_date').datetimepicker({
            //format: 'L'
            format:'DD/MM/YYYY'
        });

        
        //Date picker
        $('#to_date').datetimepicker({
            //format: 'L'
            format:'DD/MM/YYYY'
        });


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




