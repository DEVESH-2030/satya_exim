<div class="tab-pane fade" id="orders">
    <div class="row">
        <div class="col-12"> {{-- @dd($ordersList) --}}
            <div class="card dashboard-table mt-0">
               
                <div class="card-body">
                     <div class="dashboard-title">
                            <h4>Orders</h4>
                        </div>
                    <table class="table table-responsive-sm mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Order id</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order Amount</th>
                                <th scope="col">Order Status</th>
                                <!-- <th scope="col">Order Dtails</th> -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $sr =1;
                            @endphp
                            
                            @foreach($ordersList as $ordersdetails)
                            <tr>
                                <td scope="row">{{ $sr++ }}</td>
                                <td scope="row">{{$ordersdetails->order_id ??''}}</td>
                                <td scope="row">
                                    @php 
                                         $orderDate = date('Y-m-d',strtotime($ordersdetails->created_at));
                                    @endphp
                                    {{$orderDate ??''}}
                                </td>
                                <td scope="row">₹ {{$ordersdetails->order_amount ??''}} </td>
                                <td scope="row">
                                    @if($ordersdetails->order_status == '1' ??'')
                                            <span class="badge badge-danger">In Progress</span>
                                            @elseif($ordersdetails->order_status == '2' ??'')
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($ordersdetails->order_status == '3' ??'')
                                            <span class="badge badge-success">Delivered</span>
                                            @else
                                            <span class="badge badge-primary">Cancelled</span>
                                        @endif
                                </td>
                                <!-- <td scope="row">{{$ordersdetails->payment_status ??''}}</td> -->
                                <td scope="row"><a href="{{ action('Website\UserProfileController@orderDetail', [$ordersdetails->id]) }}">Order Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>