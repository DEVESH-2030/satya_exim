
@extends('admin.layout.app')

  @section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Product List
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Product Management</li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-horizontal" action="{{ action('Admin\ProductController@index') }}" method="get">
                          <div class="form-row">
                            <div class="form-group col-md-3">
                              <label for="">Product ID</label>
                              <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Enter Product ID" value="<?php echo $product_id ??'' ?>">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Product Name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" value="<?php echo $name ??'' ?>">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Category</label>
                              <select class="form-control  main-category" name="category_id" id="category_id">
                               <option value="">Select Category</option>
                              @foreach($categories as $category)
                               <option value="{{$category->id}}" {{$category->id==$category_id?'selected':''}}>{{$category->name}}</option>
                              @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Sub Category</label>
                             <select class="form-control sub-category" name="sub_category_id" id="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                    @foreach($subcategory as $subcategories)
                                    <option value="{{$subcategories->id}}" {{$subcategories->id==$sub_category_id?'selected':''}}>{{$subcategories->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Status</label>
                              <select class="form-control" name="status">
                                <option value="" >All</option>
                                <option value="1" <?php echo $status=='1'?'selected':'' ?>>Active</option>
                                <option value="0" <?php echo $status=='0'?'selected':'' ?>>Inactive</option>
                             </select>
                            </div>
                            <div class="form-group d-flex align-items-end col-md-3">
                                <button class="btn btn-primary mr-2" type="submit">Search</button>
                                <a href="{{route('product')}}" class="btn btn-secondary" type="button">Reset</a>
                            </div>
                          </div>
                        </form>
                    </div>
                    <div class="card-body order-datatable">  
                        <div class="btn-popup pull-right">
                            <a href="{{url('admin/add-product')}}" class="btn btn-primary">Add Product</a>
                           
                        </div> 
                        <div class="clearfix"></div>
                        <table class="display jsgrid" id="basic-1">
                            <thead>
                                <tr>
                                   <th style="width: 10px;">Sr. No.</th>
                                    <th>Image </th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Color</th>
                                    <th>Brand</th>
                                    <th>Variant</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th style="width: 54px;"> Action </th>
                                </tr>
                            </thead>
                            <tbody> 

                             @php 
                             $sr = 1; 
                             $page=1;
                             if(Request::input('page'))
                             $page=Request::input('page');
                             $sort = $products->perPage();
                            @endphp
                          
                           @foreach($products as $key => $product)
                                <tr>
                                    <td class="sorting_1">{{$sr++}}</td>
                                    <td><img src="{{asset($product->productImage ? ($product->productImage->first()->image ?? '') :'')}}" alt="product" style="width: 70px; height: 70px;"></td>
                                    <td> {{ $product->id ?? '' }} </td>
                                    <td> {{ $product->title ?? '' }} </td>
                                    <td> {{ $product->category ? $product->category->name : '' }} </td>
                                    <td> {{ $product->subCategory ? $product->subCategory->name : '' }} </td>
                                    <td> {{ $product->color ? $product->color->name : '' }} </td>
                                    <td> {{ $product->brand ? $product->brand->name : '' }} </td>
                                    <td> {{ $product->variant ? $product->variant->name : '' }} </td>
                                    <td> {{ $product->remaning_stock }} </td> 
                                    <td>
                                      @if($product->status == 1)
                                      <span class="text-success">Active</span>
                                      @else
                                      <span class="text-danger">Inactive</span>
                                      @endif
                                    </td>
                                    <td> 
                                      @if($product->feature_status == 1)
                                      <span class="text-success">Featured</span>
                                       @else 
                                      <span class="text-danger">Unfeatured</span>
                                      @endif
                                    </td>
                                    <td>
                                      <div class="d-flex">
                                     <!-- use edit  -->
                                     <a href="{{url('admin/edit-product') }}/{{$product->id}}" class="mr-2"><i class="fa fa-pencil-square-o text-success"></i></a>

                                       <!-- view details -->
                                      <a href="{{ action('Admin\ProductController@view',[$product->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 "></a>  

                                       @if($product->status == 1)
                                           <button type="button" id="deactivate" href="{{ action('Admin\ProductController@status',[$product->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                        @else
                                            <button type="button" id="activate" href="{{ action('Admin\ProductController@status',[$product->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                        @endif  

                                        @if($product->feature_status == 1)
                                        <button type="button" id="unfeatured" href="{{ action('Admin\ProductController@featuredStatus',[$product->id]) }}" class="btn btn-primary btn-xs ml-1">Unfeatured</button>
                                        @else
                                        <button type="button" id="featured" href="{{ action('Admin\ProductController@featuredStatus',[$product->id]) }}" class="btn btn-primary btn-xs ml-1">Featured</button>
                                        @endif
                                      </div>
                                     
                                    </td>
                                  </tr>
                      @endforeach
                            </tbody>
                        </table>
                          <!-- <div class="row">
                           <div class="col-md-6 text-left" style="margin: 20px 0px;">
                             Showing  {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} entries
                           </div>
                           <div class="col-md-6 text-right paginationBlock">
                             {!! $products->appends(request()->input())->links() !!}
                           </div>
                         </div> -->
                    </div>
                </div>
            </div>
        </div>
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

  @endsection