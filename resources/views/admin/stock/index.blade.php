
@extends('admin.layout.app')

  @section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Stock Management
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Stock Management</li>
                    <li class="breadcrumb-item active">Stock</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                        <form class="form-horizontal" action="{{ action('Admin\StockController@index') }}" method="get">
                          <div class="form-row">
                            <div class="form-group col-md-3">
                              <label for="">Product ID</label>
                              <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Enter Product ID">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Product Name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Category</label>
                              <select class="form-control  main-category" name="category_id" id="category_id">
                               <option value="">Select Category</option>
                              @foreach($categories as $category)
                               <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Sub Category</label>
                             <select class="form-control sub-category" name="sub_category_id" id="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                    @foreach($subcategory as $subcategories)
                                    <option value="{{$subcategories->id}}">{{$subcategories->name}}</option>
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
                                <a href="{{route('stock')}}" class="btn btn-secondary" type="button">Reset</a>
                            </div>
                          </div>
                        </form>
            </div>
            <div class="card-body order-datatable">
            <table class="display jsgrid" id="basic-1">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>Remanig Stock</th>
                    <!-- <th>Returned Stock</th> -->
                    <!-- <th>Status</th> -->
                    <th>Action</th>
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

                    @foreach($products as $product) 
                    <tr>
                        <td> {{ $sr++ }} </td>
                        <td> {{ $product->title ?? '' }} </td>
                        <td> {{ $product->category ? $product->category->name : '' }} </td>
                        <td> {{ $product->subCategory ? $product->subCategory->name : '' }} </td>
                        <td> {{ $product->remaning_stock }} </td> 
                        <td>
                            {{-- use edit  --}}
                            <a type="button" data-href="{{action('Admin\StockController@update',[$product->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="text-success fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Container-fluid Ends-->
   <!--  <div class="modal fade" id="viewstock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Stock Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                       <table class="table">
                           <tr>
                               <td><b>Product Id</b></td>
                               <td>#001</td>
                           </tr>
                           <tr>
                               <td><b>Product Name</b></td>
                               <td>Samsung Galaxy F41</td>
                           </tr>
                           <tr>
                               <td><b>Category Name</b></td>
                               <td>Mobile</td>
                           </tr>
                           <tr>
                               <td><b>Stock ID</b></td>
                               <td>S001</td>
                           </tr>
                           <tr>
                               <td><b>Recent Stock</b></td>
                               <td>12</td>
                           </tr>
                           <tr>
                               <td><b>Yearly Stock</b></td>
                               <td>15</td>
                           </tr>
                           <tr>
                               <td><b>Stock to be given</b></td>
                               <td>3</td>
                           </tr>
                           <tr>
                               <td><b>Returned Stock</b></td>
                               <td>2</td>
                           </tr>
                           <tr>
                               <td><b>Status</b></td>
                               <td>Active</td>
                           </tr>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div> -->
  @endsection