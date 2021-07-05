
@extends('admin.layout.app')

    @section('content')
                 <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Edit Product
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Product Management</li>
                                <li class="breadcrumb-item active">Edit Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
               <form  class="storeproduct" action="{{ url('admin/edit-product') }}" method="post" enctype="multipart/form-data" id="UpdateProduct">
                    <div class="row product-adding">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>General</h5>
                                </div>
                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0">Product Name<span>*</span> </label>
                                            <input class="form-control" id="validationCustom01" type="text" name="title" required="" value="{{$products->title}}">
                                        </div>
                                       <div class="form-group">
                                            <label class="col-form-label">Product Type<span>*</span> </label>
                                            <select class="custom-select" required="" name="product_type">
                                                <option value="">--Select Product type--</option>
                                                <option value="1" {{'1'==$products->product_type ? 'selected':''}}>Mobile</option>
                                                <option value="2" {{'2' == $products->product_type ? 'selected':''}}>Accessories</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Category<span>*</span> </label>
                                            <select class="custom-select  main-category" name="category_id" id="category_id" required="required">

                                             <option value="">--Select Category--</option>
                                            @foreach($categories as $category)
                                             <option value="{{$category->id}}" {{$category->id==$products->category_id?'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Sub Category<span>*</span></label>
                                            <select class="custom-select sub-category" name="sub_category_id" id="sub_category_id" required="required">
                                          <option value="">--Select Sub Category--</option>
                                             @foreach($subcategories as $subcategory)
                                             <option value="{{$subcategory->id}}" {{$subcategory->id==$products->sub_category_id?'selected':''}}>{{$subcategory->name}}</option>
                                             @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Brand<span>*</span> </label>
                                            <select class="custom-select" required="" name="brand_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($brands as $brand)
                                                  <option value="{{$brand->id}}" {{$brand->id==$products->brand_id?'selected':''}}>{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Color<span>*</span> </label>
                                            <select class="custom-select" required="" name="color_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($colors as $color)
                                                  <option value="{{$color->id}}" {{$color->id==$products->color_id?'selected':''}}>{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Variant<span>*</span> </label>
                                            <select class="custom-select" required="" name="variant_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($variants as $variant)
                                                  <option value="{{$variant->id}}" {{$variant->id==$products->variant_id?'selected':''}}>{{$variant->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Sort Summary</label>
                                            <textarea rows="5" cols="12" name="short_description" required="">{{$products->short_description ?? ''}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Original Price<span>*</span> </label>
                                            <input class="form-control" id="original_price" type="text" required="" name="original_price" onkeyup="GetTotalSellingPrice(0)" value="{{ $products->original_price ?? '' }}" onkeypress="return validateFloatKeyPress(this,event);">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Discount (%)<span>*</span> </label>
                                            <input class="form-control" id="discount_product_percentage" type="number" required="" name="discount_product_percentage" onkeyup="GetTotalSellingPrice(0)" value="{{ $products->discount_product_percentage ?? '' }}" onkeypress="return numbersonly(event)" max="100" maxlength="3">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Selling Price<span>*</span> </label>
                                            <input class="form-control" type="text" required="" name="" id="selling_price" readonly="" value="{{ $products->selling_price ?? '' }}">
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add Description & Image</h5>
                                </div>
                                <div class="card-body">
                                     <div class="form-group">
                                    <label class="col-form-label pt-0">Upload Product Image</label>
                                        <div class="upload-image">
                                            <div class="imageclick" onclick="document.getElementById('getimage').click()"><i class="fa fa-cloud-upload"></i>
                                            <h4 class="mb-0 f-w-600">Drop files here or click to upload.</h4>
                                            </div>
                                            <input type="file" name="product_image[]" multiple class="form-control" id="getimage" style="opacity: 0;position: absolute;" accept=".png,.jpg,.jpeg">
                                            
                                            <div class="gallery d-flex flex-wrap justify-content-center mt-4"></div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                            <label class="col-form-label pt-0">Description</label>
                                            <div class="description-sm">
                                                <textarea id="editor1" name="long_description" cols="10" rows="4" class="form-control">{{$products->long_description ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Key and Features</label>
                                            <div class="description-sm">
                                                <textarea id="editor2" name="key_feature" cols="10" rows="4" class="form-control">{{$products->long_description ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="product-buttons text-center">
                                                <button type="submit" class="btn btn-primary" id="loderButton"><i class="fa fa-spinner fa-pulse fa-fw " id="loderIcon" style="display:none;"></i>Update</button>
                                                <a href="{{url('admin/product')}}" type="reset"  class="btn btn-outline-primary">Cancel</a>
                                                 
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Container-fluid Ends-->


    @endsection

      @section('js')
<script type="text/javascript">
      $(document).ready(function()
  {
         $('.main-category').on('change', function() {         
      var category_id = $(this).val(); 
      if(category_id) {
        $.ajax({
         url: '{{ route("json-subcategory") }}',
         type: "GET",
         data : {'category_id':category_id,"_token":"{{ csrf_token() }}"},
         dataType: "json",
         success:function(data) {
          if(data){ 
           $('.sub-category').empty();
           $('.sub-category').focus;
           $('.sub-category').append('<option value="">Select Sub Category</option>'); 
           $.each(data, function(key, value){                         
           $('.sub-category').append('<option value="'+ value.id +'">' + value.name + '</option>');
          });
          } else {
            $('.sub-category').empty();
          }
         }
        });
      } else {
        $('.sub-category').empty();
      }
  });
     });
</script>


 <script type="text/javascript">
      $(document).on('submit', 'form#UpdateProduct', function(e){
             e.preventDefault();
       $('#loderIcon').show();
       $('#loderButton').prop("disabled", true);       
             $.ajax({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                 url:$(this).attr('action'),
                 method: $(this).attr('method'),
                 //data: $(this).serialize(),
                 data:new FormData(this),
                 contentType:false,
                 processData:false,
                 dataType: 'json',
                 success: function(response) {
                 $('#loderIcon').hide();
                 $('#loderButton').prop("disabled", false);
                  if(response.code==200)
                   {
                    toastr.success(response.message);
                    window.location.href = "{{ route('product')}}";
                   }else{
                    toastr.error(response.message);
                     return false;
                   }

                   
                 }
         
             });
         
         });
         
      </script>


      <script type="text/javascript">
   function GetTotalSellingPrice() { 
   var original_price = document.getElementById('original_price').value;
   var discount = document.getElementById('discount_product_percentage').value;
   
         if(discount!='' && original_price!='')        
          {
            var total =original_price - (discount * original_price)/100;
            var total_price =total.toFixed(2);
            $("#selling_price").val(total_price);
          }else{
             $("#selling_price").val('');
          }
  }  
</script>

@endsection