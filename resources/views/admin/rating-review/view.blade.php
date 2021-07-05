<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title f-w-600" id="exampleModalLabel">Rating and Review Details</h5>
            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">   
            <form class="needs-validation" action="" method="get" enctype="multipart/form-data" name="view_model" id="view_model">
             
                <div class="table-responsive">
                  <table class="table">
                       <tr>
                           <td><b>Product ID</b></td>
                           <td>{{$rating->product_id ??''}}</td>
                       </tr>
                       <tr>
                           <td><b>Product Name</b></td>
                           <td>{{$rating->productData->first()->title ??''}}</td>
                       </tr>
                       <tr>
                           <td><b>Customer ID</b></td>
                           <td>{{$rating->user_id ??''}}</td>
                       </tr>
                       <tr>
                           <td><b>Customer Name</b></td>
                           <td>{{$rating->name ??''}}</td>
                       </tr>
                       <tr>
                           <td><b>Rating</b></td>
                           <td>
                              @php
                                $ratingStar = App\Models\RatingReview::where('product_id', $rating->id)->first();
                                $value = $ratingStar->rating; 
                                $final_rating = $value*(100/5); 
                              @endphp 
                              <span class="score" style="display: block;">
                                <div class="score-wrap">
                                  <span class="stars-active" style="width:{{ $final_rating }}%"> 
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                  </span>
                                  <span class="stars-inactive">
                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                  </span>
                                </div>
                              </span>
                          </td>
                       </tr>
                       <tr>
                           <td><b>Review</b></td>
                           <td>{{ $rating->review ??'' }}</td>
                       </tr>
                       <tr>
                           <td><b>Status</b></td>
                           <td>
                              @if($rating->status == 1 ??'')
                                <span class="text-success">Active</span>
                              @else
                                <span class="text-danger">Inactive</span>
                              @endif
                            </td>
                       </tr>
                  </table>
                </div>
            </form>
        </div>
    </div>
</div>