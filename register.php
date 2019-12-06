
                        <!-- Material form register -->
                        <form action="run_cmd.php" method="post">
                            <!-- Material input text -->
                            <div class="md-form">
                                <input type="text" name="txtid_no" id="txtid_no" class="form-control" required="">
                                <label for="txtid_no" class="font-weight-light">ID Number</label>
                            </div>
                             <div class="md-form">
                                <input type="text" name="txtfname" id="txtfname" class="form-control" required="">
                                <label for="txtfname" class="font-weight-light">First Name</label>
                            </div>

                             <div class="md-form">
                                <input type="text" name="txtlname" id="txtlname" class="form-control" required="">
                                <label for="txtlname" class="font-weight-light">Last Name</label>
                            </div>

                            <div class="md-form">
                                <input type="text" name="txtmi" id="txtmi" class="form-control">
                                <label for="txtmi" class="font-weight-light">Middle Initial</label>
                            </div>

                            <div class="md-form">
                                
                                <input type="text" name="txtusername" id="txtusername" class="form-control" required="">
                                <label for="txtusername" class="font-weight-light">Username</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <input type="password" name="txtpassword" id="txtpassword" class="form-control" required="">
                                <label for="txtpassword" class="font-weight-light">Password</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="txtcpassword" id="txtcpassword" class="form-control" required="">
                                <label for="txtcpassword" class="font-weight-light">Confirm Password</label>
                            </div>

                            <div class="text-center py-4 mt-3">
                                <a href="index.php"><i class="fa fa-arrow-left"></i> Back to login</a>
                                <button name="btnSignup" type="submit" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Sign Up</button>
                            </div>
                         
                        </form>

                    