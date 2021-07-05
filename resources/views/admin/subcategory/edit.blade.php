
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Sub Category</h5>
                            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body"> 
                            <form class="needs-validation" action="{{ action('Admin\SubCategoryController@edit',[ $subcategory->id]) }}" method="post" enctype="multipart/form-data" name="edit_model" id="edit_model">
                                @csrf
                                <div class="form">
                                    <div class="form-group">
                                            <label class="col-form-label">Category<span class="required" style="color: red;">*</span></label>
                                            <select class="form-control main-category" name="category_id" id="category_id" required="required">

                                             <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                             <option value="{{$category->id}}" {{$category->id==$subcategory->category_id?'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">Sub Category Name<span class="required" style="color: red;">*</span></label>
                                        <input class="form-control" name="name" placeholder="Enter Sub Category" id="validationCustom01" type="text" value="{{$subcategory->name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="file1" class="mb-1">Sub Category Image<span class="required" style="color: red;">*</span></label>
                                        <input class="form-control" name="image" id="file1" type="file"  onchange="return imgValidation1(event)" accept=".png,.jpg,.jpeg">
                                        @if($subcategory->image)
                                         <img src="{{asset($subcategory->image)}}" class="img-circle mt-2" width="125" height="125" alt="{{$subcategory->name}}">
                                        @endif
                                    </div>
                                    <div class="form-group text-center">
                                       <button type="submit" class="btn btn-primary" id="loderButton"><i class="fa fa-spinner fa-pulse fa-fw" id="loderIcon" style="display:none;"></i>Update <i class="far fa-gem ml-1 text-white"></i></button>
                                       <a type="button" class="btn btn-outline-primary waves-effect cancel-model" data-dismiss="modal">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           