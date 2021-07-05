<div class="tab-pane fade" id="change-password">
    <div class="row">
        <div class="col-12">
            <div class="card mt-0">
                <div class="card-body"> 
                    <div class="dashboard-box">
                        <div class="dashboard-title">
                            <h4>Change Password</h4>
                        </div>
                        <div class="dashboard-detail">
                            
                            <div class="account-setting">
                               
                                <div class="row">
                                    <div class="col">
                                        <form class="theme-form profile-form" action="{{ action('Website\UserProfileController@forgotPassword', [$user->id])}}" method="post">
                                            @csrf
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <label for="password">Old Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Old Password" required="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="newpassword">New Password</label>
                                                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Enter New Password" required="">
                                                </div>
                                            </div>
                                            <div class="form-row pt-3" >
                                                
                                                <div class="col-md-6">
                                                    <label for="confirmpassword">Confirm Password</label>
                                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Enter Confirm Password" required="">
                                                     <small class="error text-danger"></small>
                                                </div>  
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-solid btn-xs mt-4">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>