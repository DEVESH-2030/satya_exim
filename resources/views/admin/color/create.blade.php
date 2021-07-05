 <!-- add category -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Color</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body"> 
                <form class="needs-validation" action="{{ action('Admin\ColorController@store') }}" method="post" name="add_model" id="add_model" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form">
                        <div class="form-group">
                            <label for="validationCustom01" class="mb-1">Color Name<span class="required" style="color: red;">*</span>
                            </label>
                            <input class="form-control" name="name" id="validationCustom01" type="text" required="">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom01" class="mb-1">Color</label>
                            <div class="input-group">
                            <input type="text" name="" value="" class="form-control p-relative" id="color-value" disabled>
                            <span id="color-box" class="colorpic" onclick="document.getElementById('getFile').click()"><i class="fa fa-picker"></i></span>
                            <input onchange="mycolor()" type="color" name="color_code" class="form-control" id="getFile" style="display: none;">
                            </div>
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

        <script>
$(function () {
var color = $("#getFile").val();
$("#getFile").change(function(){
$("#color-box").css('background', $(this).val());
$("#color-value").val($(this).val());
});

});
</script>