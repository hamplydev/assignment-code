<form role="form" id="form" action="{{ route('attendance.checkout') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf



<div class="row">

    

    <div class="col-md-4" style="">  



         <div class="form-group">
                  <label>Employee Name</label>
                  <div class="controls">
                  <select class="form-control select2" name="employee_id" style="width: 100%;">
                        <option value>Choose</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name.' '.$employee->last_name }}</option>
                        @endforeach
                  </select>
                </div>
        </div>

    </div>

    <div class="col-md-4">        
        <div class="form-group">
            <label>Puch Time</label>
            <div class="input-group date" id="time_out" data-target-input="nearest">
                <input type="text" name="time_out" class="form-control datetimepicker-input" data-target="#time_out"/>
                <div class="input-group-append" data-target="#time_out" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

    </div>



</div>

<div class="row">
        <div class="col-md-8 bg-light text-right">
                <input type="hidden" name="id" id="id" value="#">
                <button type="submit" class="btn btn-primary">Check Out</button>
        </div>
</div>



         
</form>