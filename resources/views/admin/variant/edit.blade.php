 
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Variant</h5>
	            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
	            <form class="needs-validation" action="{{action('Admin\VariantController@edit',[$variant->id]) }}" method="post" enctype="multipart/form-data" name="edit_model" id="edit_model">
	                @csrf
	                <div class="form">
	                    <div class="form-group">
	                        <label for="validationCustom01" class="mb-1">Variant Name<span class="required" style="color: red;">*</span> </label>
	                        <input class="form-control" id="validationCustom01" type="text" name="name" value="{{$variant->name}}" required="">
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
