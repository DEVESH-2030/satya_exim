
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">User Details</h5>
                            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body"> 
                            <form class="needs-validation" action="{{ action('Admin\UserController@edit',[ $user->id] ?? '') }}" method="post" enctype="multipart/form-data" name="view_model" id="view_model">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table">
                                        <!-- <tr>
                                            <td><b>User Id</b></td>
                                            <td>{{$user->id}}</td>
                                        </tr> -->
                                        <tr>
                                            <td><b>User Name</b></td>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Mobile Number</b></td>
                                            <td>{{$user->mobile_no}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Country</b></td>
                                            <td>{{$user->country->name}}</td>
                                        </tr> 
                                        <tr>
                                            <td><b>State</b></td>
                                            <td>{{$user->state->name}}</td>
                                        </tr> 
                                        <tr>
                                            <td><b>City</b></td>
                                            <td>{{$user->city->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{$user->address}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pincode</b></td>
                                            <td>{{$user->pincode}}</td>
                                        </tr>
                                       <!--  <tr>
                                            <td><b>OTP</b></td>
                                            <td>{{$user->otp}}</td>
                                        </tr> -->
                                        <tr>
                                            <td><b>Account Verification</b></td>
                                            <td>
                                                @if($user->email_verify == 1)
                                                    <span class="text-success">Account Verified</span>
                                                    @else
                                                    <span class="text-danger">Account Not Verified</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                @if($user->status== 1)
                                                    <span class="text-success">Active</span>
                                                    @else
                                                    <span class="text-danger">InActive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           