
    <div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper"><a href="{{url('admin/dashboard')}}"><img class="blur-up lazyloaded" src="{{url('img/logo.png')}}" alt=""></a></div>
            </div>
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <div><img class="img-60 rounded-circle lazyloaded blur-up" src="{{url($getInfo->image ?? 'admin/assets/images/dashboard/designer.jpg')}}" alt="#">
                    </div>
                    <h6 class="mt-3 f-14">{{ $getInfo->name ?? '' }}</h6>
                    <p>{{ $getInfo->email ?? '' }}</p>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="{{url('admin/dashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="users"></i> <span>Users Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('user')}}"><i class="fa fa-circle"></i>Users list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="users"></i> <span>Contact Us</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('contact-us')}}"><i class="fa fa-circle"></i>Contact Us list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="list"></i> <span>Category Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('category')}}"><i class="fa fa-circle"></i>Categories list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="layers"></i> <span>Sub Category Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('subcategory')}}"><i class="fa fa-circle"></i>Sub Categories list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Product Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/product')}}"><i class="fa fa-circle"></i>Product list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="briefcase"></i> <span>Order Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/all-order')}}"><i class="fa fa-circle"></i>All Orders List</a></li>
                            <li><a href="{{url('admin/recent-order')}}"><i class="fa fa-circle"></i>Recent Orders List</a></li>
                            <li><a href="{{url('admin/complete-order')}}"><i class="fa fa-circle"></i>Completed Orders List</a></li>
                            <!-- <li><a href="{{url('admin/scheduled-order')}}"><i class="fa fa-circle"></i>Scheduled Orders List</a></li> -->
                            <!-- <li><a href="{{url('admin/returned-order')}}"><i class="fa fa-circle"></i>Returned Orders List</a></li> -->
                        </ul>
                    </li>

                   <!--  <li><a class="sidebar-header" href="#"><i data-feather="truck"></i> <span>Order Delivery Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/order-delivery')}}"><i class="fa fa-circle"></i>Order Delivery list</a></li>
                        </ul>
                    </li> -->
                    
                    <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Stock Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('stock')}}"><i class="fa fa-circle"></i>Stock list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="image"></i> <span>Banner Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('banner')}}"><i class="fa fa-circle"></i>Banner list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="image"></i> <span>Brand Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('brand')}}"><i class="fa fa-circle"></i>Brand list</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="image"></i> <span>Variant Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('variant')}}"><i class="fa fa-circle"></i>Variant list</a></li>
                        </ul>
                    </li>
                     <li><a class="sidebar-header" href="#"><i data-feather="image"></i> <span>Color Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('color')}}"><i class="fa fa-circle"></i>Color list</a></li>
                        </ul>
                    </li>
                    <!-- <li><a class="sidebar-header" href="#"><i data-feather="percent"></i> <span>Discount Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/discount')}}"><i class="fa fa-circle"></i>Discount list</a></li>
                        </ul>
                    </li> -->

             <!-- <li><a class="sidebar-header" href="#"><i data-feather="archive"></i> <span>Coupon Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('coupon')}}"><i class="fa fa-circle"></i>Coupons list</a></li>
                        </ul>
                    </li> -->
                    <li><a class="sidebar-header" href="#"><i data-feather="book"></i> <span>Report Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('reports')}}"><i class="fa fa-circle"></i>Report List</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i> <span>Payment Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('payment')}}"><i class="fa fa-circle"></i>Payment list</a></li>
                            <!-- <li><a href="{{url('admin/refund-return')}}"><i class="fa fa-circle"></i>Refund and Return list</a></li> -->
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="star"></i> <span>Ratings & Reviews</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/rating-review')}}"><i class="fa fa-circle"></i>Rating & Review List</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="edit"></i> <span>Content Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('content')}}"><i class="fa fa-circle"></i>Pages List</a></li>
                        </ul>
                    </li> 

                    <li><a class="sidebar-header" href="#"><i data-feather="edit"></i> <span>Settings</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('setting')}}"><i class="fa fa-circle"></i>Website Setting</a></li> 
                        </ul>
                    </li>
                    <!-- <li><a class="sidebar-header" href="#"><i data-feather="edit-2"></i> <span>Theme & Font Management</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('admin/theme-font')}}"><i class="fa fa-circle"></i>Theme and Font</a></li>
                        </ul>
                    </li> -->
                    <!-- <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="#"><i class="fa fa-circle"></i>
                                    <span>Physical</span> <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><a href="category.html"><i class="fa fa-circle"></i>Category</a></li>
                                    <li><a href="category-sub.html"><i class="fa fa-circle"></i>Sub Category</a></li>
                                    <li><a href="product-list.html"><i class="fa fa-circle"></i>Product List</a></li>
                                    <li><a href="product-detail.html"><i class="fa fa-circle"></i>Product Detail</a></li>
                                    <li><a href="add-product.html"><i class="fa fa-circle"></i>Add Product</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-circle"></i>
                                    <span>Digital</span> <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><a href="category-digital.html"><i class="fa fa-circle"></i>Category</a></li>
                                    <li><a href="category-digitalsub.html"><i class="fa fa-circle"></i>Sub Category</a></li>
                                    <li><a href="product-listdigital.html"><i class="fa fa-circle"></i>Product List</a></li>
                                    <li><a href="add-digital-product.html"><i class="fa fa-circle"></i>Add Product</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i><span>Sales</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="order.html"><i class="fa fa-circle"></i>Orders</a></li>
                            <li><a href="transactions.html"><i class="fa fa-circle"></i>Transactions</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="tag"></i><span>Coupons</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="coupon-list.html"><i class="fa fa-circle"></i>List Coupons</a></li>
                            <li><a href="coupon-create.html"><i class="fa fa-circle"></i>Create Coupons </a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="clipboard"></i><span>Pages</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="pages-list.html"><i class="fa fa-circle"></i>List Page</a></li>
                            <li><a href="page-create.html"><i class="fa fa-circle"></i>Create Page</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="media.html"><i data-feather="camera"></i><span>Media</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="align-left"></i><span>Menus</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="menu-list.html"><i class="fa fa-circle"></i>Menu Lists</a></li>
                            <li><a href="create-menu.html"><i class="fa fa-circle"></i>Create Menu</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="user-plus"></i><span>Users</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="user-list.html"><i class="fa fa-circle"></i>User List</a></li>
                            <li><a href="create-user.html"><i class="fa fa-circle"></i>Create User</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="users"></i><span>Vendors</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="list-vendor.html"><i class="fa fa-circle"></i>Vendor List</a></li>
                            <li><a href="create-vendors.html"><i class="fa fa-circle"></i>Create Vendor</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="#"><i data-feather="chrome"></i><span>Localization</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="translations.html"><i class="fa fa-circle"></i>Translations</a></li>
                            <li><a href="currency-rates.html"><i class="fa fa-circle"></i>Currency Rates</a></li>
                            <li><a href="taxes.html"><i class="fa fa-circle"></i>Taxes</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="reports.html"><i data-feather="bar-chart"></i><span>Reports</span></a></li>
                    <li><a class="sidebar-header" href="#"><i data-feather="settings" ></i><span>Settings</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="profile.html"><i class="fa fa-circle"></i>Profile</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-header" href="invoice.html"><i data-feather="archive"></i><span>Invoice</span></a>
                    </li>
                    <li><a class="sidebar-header" href="login.html"><i data-feather="log-in"></i><span>Login</span></a>
                    </li> -->
                </ul>
            </div>
    </div>