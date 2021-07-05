<div class="tab-pane fade show active" id="profile">
    <div class="row">
        <div class="col-12">
            <div class="card mt-0">
                <div class="card-body">  {{-- @dd($ordersList) --}}
                    <div class="dashboard-box">
                        <div class="top-sec">
                        <h3>Profile</h3>
                        <a href="{{ action('Website\UserController@editAccount', [$user->id])}}" class="btn btn-sm btn-solid">Edit Profile</a>




                    </div>
                        <div class="dashboard-detail">
                            <ul>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Name</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->first_name}} {{$user->last_name}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Contact Number</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->mobile_no}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->email}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Country</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->country->name}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>State</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->state->name}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>City</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->city->name}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Pincode</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->pincode}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="details">
                                        <div class="left">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="right">
                                            <h6>{{$user->address}}</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>