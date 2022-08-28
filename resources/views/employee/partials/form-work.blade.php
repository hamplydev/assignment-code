<div class="row">

    <div class="col-md-4">        
        <div class="form-group">
          <label>Joined Date</label>
            <div class="input-group date" id="joined_date" data-target-input="nearest">
                <input type="text" name="joined_date" class="form-control datetimepicker-input" data-target="#joined_date" value="{{ (isset($employee) && $employee->date_of_birth)? date('d/m/Y',strtotime($employee->date_of_birth)) : '' }}" />
                <div class="input-group-append" data-target="#joined_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Start Time</label>
                    <div class="input-group date" id="working_start_time" data-target-input="nearest">
                      <input type="text" name="working_start_time" class="form-control datetimepicker-input" data-target="#working_start_time" value="{{ (isset($employee) && $employee->working_start_time)? date('h:i A',strtotime($employee->working_start_time)) : '' }}" />
                      <div class="input-group-append" data-target="#working_start_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>

                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>End Time</label>
                    <div class="input-group date" id="working_end_time" data-target-input="nearest">
                      <input type="text" name="working_end_time" class="form-control datetimepicker-input" data-target="#working_end_time" value="{{ (isset($employee) && $employee->working_end_time)? date('h:i A',strtotime($employee->working_end_time)) : '' }}" />
                      <div class="input-group-append" data-target="#working_end_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>

    </div>

    <div class="col-md-4" style="">  
         <div class="form-group">
            <label for="basic_salary" class="control-label" style="line-height:20px;">Basic Salary</label>
            <div class="controls">
                <input type="text" id="basic_salary" name="basic_salary" class="form-control" placeholder=""  value="{{ isset($employee) ? $employee->basic_salary : '' }}" required>
            </div>
        </div>
    </div>


    <div class="col-md-4" style="">

    </div>


</div>


