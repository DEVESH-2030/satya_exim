<div class="modal fade" id="ajax-success-alert" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pt-0 text-center">
                <div class="modal-header">
                    <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"> 
                    <p class="show-message">
                        
                    </p>
                    <button type="button" class="btn btn-main" data-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-error-alert" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pt-0 text-center">
                <div class="modal-header">
                    <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"> 
                    <p class="show-message">
                        
                    </p>
                    <button type="button" class="btn btn-main" data-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- alert error message -->
<div class="modal x-popup-modal fade" id="error-x-popup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{url('img/x-mark.png')}}" width="100px">
                <p class="mt-3 error-message"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- <a href="#" class="btn btn-solid btn-custom">OK</a> -->
                <a href="#" class="btn btn-dark btn-custom" data-dismiss="modal">OK</a>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->


<!-- alert success mssage -->
<!-- <button class="btn btn-sm btn-solid" data-toggle="modal" data-target="#x-popup">Tick Popup Link</button> -->

<!-- Modal start -->
<div class="modal x-popup-modal fade" id="success-x-popup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Heading</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{url('img/tick-green.png')}}" width="100px">
                <p class="mt-3"> Text Message............. ............. ..... ?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="#" class="btn btn-solid btn-custom">OK</a>
                <a href="#" class="btn btn-dark btn-custom" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->