  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    Change Password
                              </div>
                              <div class="card-body">
                                
                                <form action="run_cmd.php" method="post">
                                      <div class="md-form">
                                          <input type="password" name="txtpass" id="txtpass" class="form-control validate" required="">
                                          <label for="txtpass" data-error="" data-success="" class="font-weight-light">Current Password</label>
                                      </div>
                                      <div class="md-form">
                                          <input type="password" name="txtnpass" id="txtnpass" class="form-control" required="">
                                          <label for="txtnpass" data-error="" data-success="" class="font-weight-light">New Password</label>
                                      </div>
                                      <div class="md-form">
                                          <input type="password" name="txtcpass" id="txtcpass" class="form-control validate" required="">
                                          <label for="txtcpass" data-error="" data-success="" class="font-weight-light">Confirm Password</label>
                                      </div>
                                      <button type="submit" name="btnChange" class="btn btn-primary btn-rounded btn-sm">Confirm</button>
                                </form>
                                
                                
                              </div>
                            </div>
                        </div>