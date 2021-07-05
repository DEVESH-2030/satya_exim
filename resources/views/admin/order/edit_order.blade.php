
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header"> 
            <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Order Status</h5>
            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form class="needs-validation" action="{{ action('Admin\OrderManagementController@orderstatus',[$updateOrder->id] ??'') }}" method="post" enctype="multipart/form-data" name="edit_model" id="edit_model">
                @csrf
                <div class="form">
                    <div class="form-group">
                        <label for="validationCustom01" class="mb-1">Select Status<span class="required" style="color: red;">*</span></label>
                        <select class="form-control" name="status">
                            <option value="2">Pending</option>
                            <option value="1">In Progress</option>
                            <option value="3">Delivered</option>
                            <option value="4">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom02" class="mb-1">Comment</label>
                        <textarea class="form-control" rows="3" name="comments"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-outline-primary waves-effect cancel-model" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>