@extends('layout.master')


@push('styles')


<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('vendors/plugins/dropzone/min/dropzone.min.css') }}">

<style>


</style>
@endpush


@section('content')



<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Attendance</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Attendance</a></li>
            <li class="breadcrumb-item active">Form</li>
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

    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_checkin">Check In</a></li>        
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_checkout">Check Out</a></li>
        </ul>

        <div class="tab-content" style="margin-bottom: 20px;">
            <div id="tab_checkin" class="tab-pane active"><br>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('attendance.partials.checkin')
                        </div>
                    </div>
                </div>
            </div>
            

            <div id="tab_checkout" class="tab-pane fade"><br>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('attendance.partials.checkout')
                        </div>
                    </div>
                </div>
            </div> 
        </div>

  </div>
</div>

@endsection



@push('scripts')

<!-- Select2 -->
<script src="{{ asset('vendors/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('vendors/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('vendors/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('vendors/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('vendors/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('vendors/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('vendors/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('vendors/dist/js/demo.js') }}"></script>

<script>

$(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
    //Date and time picker
    $('#time_in').datetimepicker({ icons: { time: 'far fa-clock' }, format:'DD/MM/YYYY h:mm A' });

     //Date and time picker
    $('#time_out').datetimepicker({ icons: { time: 'far fa-clock' }, format:'DD/MM/YYYY h:mm A' });

    //Timepicker
    $('#working_start_time').datetimepicker({
      format: 'LT'
    })

    //Timepicker
    $('#working_end_time').datetimepicker({
      format: 'LT'
    })


    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById("department_id").disabled = true;
    });
    // document.getElementById('department_id').disabled = false;
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