 <!-- about -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">About</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">  <!-- @dd($settings) -->
               <form class="needs-validation" action="{{ action('Admin\SettingController@store') }}" method="post" name="add_model" id="add_model" enctype="multipart/form-data"> 
                @csrf
                    <div class="form">

                        <div class="form-group">  {{-- @dd($contactus) --}}
                            <label for="validationCustom01" class="mb-1">Mobile<span style="color: red">*</span></label>
                            <input class="form-control" name="mobile" id="validationCustom01" type="number">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Location<span style="color: red">*</span></label>
                            <input class="form-control" name="location" id="validationCustom01" type="text">
                        </div> 
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Address<span style="color: red">*</span></label>
                            <textarea id="editor1" name="address" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="validationCustom03" class="mb-1">Fax<span style="color: red">*</span></label>
                            <input class="form-control" name="fax" id="validationCustom03" type="number">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" name="submit" type="submit">Add</button>
                            <button class="btn btn-outline-primary cancel-model" type="button" data-dismiss="modal">Cancel</button>
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