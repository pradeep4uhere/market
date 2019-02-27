    <div class="container">
          <div class="row ">
            <div class="col-md-8">
                <form class="form-horizontal" method="POST" action="{{ route('addaddress') }}">
                            {{ csrf_field() }}
                <div class="row ">
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Full Name</label>
                              <input type="text" id="full_name" name="full_name" class="form-control validate" required="required" placeholder="Enter Your Full Name" value="{{ old('email') }}">
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Flat No/Office Address</label>
                              <input type="text" id="address_1" name="address_1" class="form-control validate" required="required" placeholder="Email Your Address">
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Full Address</label>
                              <input type="text" id="address_2" name="address_2" class="form-control validate" required="required" placeholder="Enter Full Address">
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Landmark</label>
                              <input type="text" id="landmarks" name="landmarks" class="form-control validate" required="required" placeholder="Enter Landmarks">
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Mobile No</label>
                              <input type="text" id="mobile" name="mobile" class="form-control validate" required="required" placeholder="Enter Mobile Number" maxlength="10">
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>State</label>
                              <select class="form-control" name="state_id" onChange="getCity(this.value)" required="required">
                                  <option>Select State</option>
                                  @foreach($stateArr as $obj)
                                  <option value="{{$obj->id}}">{{$obj->state_name}}</option>
                                  @endforeach
                              </select>
                            </div>
                            
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>City</label>
                              <select class="form-control" id="city" name="city_id" required="required">
                                  <option>Select City</option>
                                 
                              </select>
                            </div>
                            
                          </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Pincode</label>
                              <input type="text" id="pincode" name="pincode" class="form-control validate" required="required" placeholder="Enter pincode">
                            </div>
                            
                          </div>
                    </div>
                    
                </div>
                    <div class="form-row">
                        <input type="hidden" id="id" name="id">
                        <button type="submit" name="login" class="btn waves-effect waves-light blue right btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

