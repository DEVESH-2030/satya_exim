
@extends('admin.layout.app')

@section('content')
                   <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Add Product
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Product Management</li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <form class="storeproduct" action="{{ action('Admin\ProductController@store') }}" method="post" enctype="multipart/form-data" id="addProduct">
                    <div class="row product-adding">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>General</h5>
                                </div>
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0">Product Name<span>*</span> </label>
                                            <input class="form-control" id="validationCustom01" type="text" required="" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Product Type<span>*</span> </label>
                                            <select class="custom-select" required="" name="product_type">
                                                <option value="">--Select Product type--</option>
                                                <option value="1">Mobile</option>
                                                <option value="2">Accessories</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Category<span>*</span> </label>
                                            <select class="custom-select  main-category" name="category_id" id="category_id" required="required">

                                             <option value="">--Select Category--</option>
                                            @foreach($categories as $category)
                                             <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Sub Category<span>*</span> </label>
                                            <select class="custom-select sub-category" name="sub_category_id" id="sub_category_id" required="required">
                                              <option value="">--Select Sub Category--</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Brand<span>*</span> </label>
                                            <select class="custom-select" required="" name="brand_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($brands as $brand)
                                                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Color<span>*</span> </label>
                                            <select class="custom-select" required="" name="color_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($colors as $color)
                                                  <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label"> Variant<span>*</span></label>
                                            <select class="custom-select" required="" name="variant_id" required="">
                                                <option value="">--Select--</option>
                                                @foreach($variants as $variant)
                                                  <option value="{{$variant->id}}">{{$variant->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="validationCustomtitle" class="col-form-label pt-0">Stock<span>*</span> </label>
                                            <input class="form-control" id="validationCustomtitle" type="text" required="" name="total_stock" onkeypress="return numbersonly(event)">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Sort Summary</label>
                                            <textarea rows="5" cols="12" name="short_description" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Original Price<span>*</span> </label>
                                            <input class="form-control" id="original_price" type="text" required="" name="original_price" onkeyup="GetTotalSellingPrice()"  onkeypress="return validateFloatKeyPress(this,event);">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Discount(%)<span>*</span> </label>
                                            <input class="form-control" id="discount_product_percentage" type="text" required="" name="discount_product_percentage" onkeyup="GetTotalSellingPrice()" maxlength="3" onkeypress="return numbersonly(event)">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">Selling Price<span>*</span> </label>
                                            <input class="form-control" type="text" required="" name="" id="selling_price" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Status<span>*</span> </label>
                                            <div class="m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                <label class="d-block" for="edo-ani">
                                                    <input class="radio_animated" id="edo-ani" type="radio" name="status" value="1" checked>
                                                    Active
                                                </label>
                                                <label class="d-block" for="edo-ani1">
                                                    <input class="radio_animated" id="edo-ani1" type="radio" name="status" value="0">
                                                    Inactive
                                                </label>
                                            </div>
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
                                    <label class="col-form-label pt-0">Upload Product Image </label>
                                        <div class="upload-image">
                                            <div class="imageclick" onclick="document.getElementById('getimage').click()"><i class="fa fa-cloud-upload"></i>

                                            <h4 class="mb-0 f-w-600">Drop files here or click to upload.</h4>
                                            </div>
                                            <input type="file" name="product_image[]" multiple class="form-control" id="getimage" style="opacity: 0;position: absolute;" required="" accept=".png,.jpg,.jpeg">

                                            <div class="gallery d-flex flex-wrap justify-content-center mt-4"></div>

                                        </div>
                                    </div>
                                     <div class="form-group">
                                            <label class="col-form-label pt-0">Description</label>
                                            <div class="description-sm">
                                                <textarea id="editor1" name="long_description" cols="10" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Key and Features</label>
                                            <div class="description-sm">
                                                <textarea id="editor2" name="key_feature" cols="10" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="product-buttons text-center">
                                                <button type="submit" class="btn btn-primary" id="loderButton"><i class="fa fa-spinner fa-pulse fa-fw " id="loderIcon" style="display:none;"></i>Add</button>
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
      $(document).on('submit', 'form#addProduct', function(e){
         //alert('test');
             e.preventDefault();

         // data:new FormData(this),
         // contentType:false,
         // processData:false,
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
                    document.getElementById("addProduct").reset();
                    location.reload();
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