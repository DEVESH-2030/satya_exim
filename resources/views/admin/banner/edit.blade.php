 
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Banner</h5>
	            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
	            <form class="needs-validation" action="{{action('Admin\BannerController@edit',[$banner->id]) }}" method="post" enctype="multipart/form-data" name="edit_model" id="edit_model">
	                @csrf
	                <div class="form">
	                   
	                    <div class="form-group">
	                        <label for="file1" class="mb-1">Banner Image</label>
	                        <input class="form-control" id="file1" type="file" name="image" onchange="return imgValidation1(event)" accept=".png,.jpg,.jpeg">
	                        @if($banner->image)
                           <img src="{{asset($banner->image)}}" class="img-circle mt-2" width="125" height="125" alt="category Image">
                           @endif
	                    </div>
	                    <div class="form-group text-center">
	                        <button type="submit" class="btn btn-primary" id="loderButton"><i class="fa fa-spinner fa-pulse fa-fw" id="loderIcon" style="display:none;"></i>Update <i class="far fa-gem ml-1 text-white"></i></button>
			               <button type="button" class="btn btn-outline-primary waves-effect cancel-model" data-dismiss="modal">Cancel</button>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
