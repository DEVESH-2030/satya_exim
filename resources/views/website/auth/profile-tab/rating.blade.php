    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="addModalLabel">Add Review</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation " action="{{action('Website\UserProfileController@reviewAndRating', [$id, $orderId])}}" method="post" name="add_review" id="add_review" enctype="multipart/form-data" > 
                	@csrf
                     <div class="form custom-label-margin">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="media">
                                    <label>Rating</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div id="half-stars-example">
                                                <div class="rating-group">
                                                    <input class="rating__input rating__input--none" checked="" name="rating" id="rating2-0" value="0" type="radio">
                                                    <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                                                    <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio">
                                                    <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio">
                                                    <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" >
                                                    <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio">
                                                    <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio">
                                                    <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio">
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your name" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required="">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="review">Review </label>
                                <textarea class="form-control" placeholder="Wrire review" name="review" id="review" rows="6"></textarea>
                            </div>
                           
                        </div>
                        
                        <div class="form-group text-right pt-4">
                            <button class="btn btn-sm btn-dark" type="submit">Add</button>
                            <button class="btn btn-sm btn-dark waves-effect cancel-model" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>