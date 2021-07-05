 <!-- add category -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Brand</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body"> 
                <form class="needs-validation" action="{{ action('Admin\BrandController@store') }}" method="post" name="add_model" id="add_model" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form">
                        <div class="form-group">
                            <label for="validationCustom01" class="mb-1">Brand Name<span class="required" style="color: red;">*</span></label>
                            <input class="form-control" name="name" id="validationCustom01" type="text" required="">
                        </div>
                        <div class="form-group">
                            <label for="file" class="mb-1">Brand Image<span class="required" style="color: red;">*</span></label>
                            <input class="form-control" name="image" id="file" type="file" required="" onchange="return imgValidation(event)" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="form-group text-center">
                            <button name="submit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-outline-primary cancel-model" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
        <!-- End add model -->