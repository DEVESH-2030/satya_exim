 <!-- about -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">About</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body"> 
               <form class="needs-validation" action="{{ action('Admin\ContentManagementController@store') }}" method="post" name="add_model" id="add_model" enctype="multipart/form-data"> 
                @csrf
                    <div class="form">
                        <div class="form-group">
                            <label for="validationCustom01" class="mb-1">Title<span style="color: red">*</span></label>
                            <input class="form-control" name="title" id="validationCustom01" type="text">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Description<span style="color: red">*</span></label>
                            <textarea id="editor1" name="description" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file" class="mb-1">Image<span style="color: red">*</span></label>
                            <input class="form-control" name="image" id="file" type="file" onchange="return imgValidation(event)" accept=".png,.jpg,.jpeg">

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="submit" type="submit">Update</button>
                            <button class="btn btn-secondary cancel-model" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
</script>        