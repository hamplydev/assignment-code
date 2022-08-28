        <div class="row"> 
            <input type="hidden"  name="id" id="id" value="#">
            <div class="col-md-4"> 
                <div class="form-group">
                    <label for="first_name" class="control-label" style="line-height:20px;">First Name</label>
                    <div class="controls">
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder=""  value="" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Department Name </label>
                    <input type="text" class="form-control" id="name" name="name" required="required" value="{{ isset($employee) ? $employee->name : '' }}" placeholder="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ isset($employee) ? $employee->description : '' }}" placeholder="">
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