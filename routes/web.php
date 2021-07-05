<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|----------------------------------------------------
|  This Project developed by Devesh Kumar	  
|----------------------------------------------------
|  Date - 04-07-2021
|----------------------------------------------------
|  Details-  
|
*/
/*
|
|------------------------------------------------------ 
| Start Website routes
|------------------------------------------------------
|
*/
# Route for home page 
Route::get('/', 'Website\HomeController@index')->name('/');
// Route::get('/', 'Website\UserController@index');
Route::get('/register', 'Website\UserController@register');
Route::get('/edit-account/{id}', 'Website\UserController@editAccount');
Route::post('/edit-account/{id}', 'Website\UserController@edit');
Route::any('/create-account', 'Website\UserController@store');
Route::any('/verifyEmailUrl', 'Website\UserController@verifyEmailUrl'); 
Route::any('/email_verification/{email}', 'Website\UserController@verifyEmailUrl');
# Contact Us Send mail     
Route::any('/contact-us-mail', 'Website\ContactUsMailController@store');
# Route for category
Route::get('/category', 'Website\HomeController@index')->name('/category');
Route::get('/newsalert', 'Website\HomeController@newsalert')->name('/newsalert');
Route::post('/newsalert-add', 'Website\HomeController@newsalertAdd')->name('/newsalert-add');
Route::get('/sub-category', 'Website\SubCategoryController@index')->name('/sub-category');
#Route for Product
Route::get('/product', 'Website\ProductController@index')->name('/product');
Route::get('/product-details/{slug}', 'Website\HomeController@productDetails')->name('/product-details');

// Route::post('/review-rating/{id}', 'Website\HomeController@reviewAndRating')->name('/review-rating');
Route::get('/wishlist', 'Website\HomeController@wishList')->name('/wishlist');

/*
|----------------------------------------
| End Website routes 
|----------------------------------------
*/
    
# Start Admin Routes
//Route::get('admin/login', 'Admin\AdminController@index');
Route::get('/admin/admin-login', 'Admin\AdminController@index')->name('admin.index');

//Route::post('admin/login-submit', 'Admin\AdminController@login'); 
Route::post('/adminLogin', 'Admin\AdminController@login')->name('adminLogin');   
    
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() 
{    
    # Admin profile management
    Route::get('profile', 'Admin\AdminController@Profile');
    Route::post('update-profile', 'Admin\AdminController@Update_Profile');
    Route::post('update-admin-password', 'Admin\AdminController@post_change_password');

    # dashboard route
    Route::any('dashboard', 'Admin\OrderManagementController@totalCount')->name('home');
    
    // Route::any('dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('home');

    # admin logout
    Route::get('/admin-logout', 'Admin\AdminController@logout');

       # Category Management
        Route::get('category', 'Admin\CategoryController@index')->name('category');
        Route::get('add-category', 'Admin\CategoryController@create');
        Route::post('store-category', 'Admin\CategoryController@store');
        Route::get('edit-category/{id}', 'Admin\CategoryController@update');
        Route::post('edit-category/{id}', 'Admin\CategoryController@edit');
        Route::get('view-category/{id}', 'Admin\CategoryController@view');
        Route::delete('delete-category/{id}', 'Admin\CategoryController@delete');
        Route::post('category-status/{id}', 'Admin\CategoryController@status');

        # Sub Category
        Route::get('sub-category', 'Admin\SubCategoryController@index')->name('subcategory');
        Route::get('add-sub-category', 'Admin\SubCategoryController@create');
        Route::post('store-sub-category', 'Admin\SubCategoryController@store');
        Route::get('edit-sub-category/{id}', 'Admin\SubCategoryController@update');
        Route::post('edit-sub-category/{id}', 'Admin\SubCategoryController@edit');
        Route::get('view-sub-category/{id}', 'Admin\SubCategoryController@view');
        Route::delete('delete-sub-category/{id}', 'Admin\SubCategoryController@delete');
        Route::post('sub-category-status/{id}', 'Admin\SubCategoryController@status');
        Route::get('json-subcategory', 'Admin\SubCategoryController@jsonSubcategory')->name('json-subcategory');
        

        # Banner
        Route::get('banner', 'Admin\BannerController@index')->name('banner');
        Route::get('add-banner', 'Admin\BannerController@create');
        Route::post('store-banner', 'Admin\BannerController@store');
        Route::get('edit-banner/{id}', 'Admin\BannerController@update');
        Route::post('edit-banner/{id}', 'Admin\BannerController@edit');
        Route::get('view-banner/{id}', 'Admin\BannerController@view');
        Route::delete('delete-banner/{id}', 'Admin\BannerController@delete');
        Route::post('banner-status/{id}', 'Admin\BannerController@status');

        # Brands
        Route::get('brand', 'Admin\BrandController@index')->name('brand');
        Route::get('add-brand', 'Admin\BrandController@create');
        Route::post('store-brand', 'Admin\BrandController@store');
        Route::get('edit-brand/{id}', 'Admin\BrandController@update');
        Route::post('edit-brand/{id}', 'Admin\BrandController@edit');
        Route::get('view-brand/{id}', 'Admin\BrandController@view');
        Route::delete('delete-brand/{id}', 'Admin\BrandController@delete');
        Route::post('brand-status/{id}', 'Admin\BrandController@status');

        # Variant
        Route::get('variant', 'Admin\VariantController@index')->name('variant');
        Route::get('add-variant', 'Admin\VariantController@create');
        Route::post('store-variant', 'Admin\VariantController@store');
        Route::get('edit-variant/{id}', 'Admin\VariantController@update');
        Route::post('edit-variant/{id}', 'Admin\VariantController@edit');
        Route::get('view-variant/{id}', 'Admin\VariantController@view');
        Route::delete('delete-variant/{id}', 'Admin\VariantController@delete');
        Route::post('variant-status/{id}', 'Admin\VariantController@status');

        # User
        Route::get('user', 'Admin\UserController@index')->name('user');
        Route::get('add-user', 'Admin\UserController@create');
        Route::post('store-user', 'Admin\UserController@store');
        Route::get('edit-user/{id}', 'Admin\UserController@update');
        Route::post('edit-user/{id}', 'Admin\UserController@edit');
        Route::get('view-user/{id}', 'Admin\UserController@view');
        Route::delete('delete-user/{id}', 'Admin\UserController@delete');
        Route::post('user-status/{id}', 'Admin\UserController@status');
        Route::get('view-user/{id}', 'Admin\UserController@viewDetail');

        # coupon
        Route::get('coupon', 'Admin\CouponController@index')->name('coupon');
        Route::get('add-coupon', 'Admin\CouponController@create');
        Route::post('store-coupon', 'Admin\CouponController@store');
        Route::get('edit-coupon/{id}', 'Admin\CouponController@update');
        Route::post('edit-coupon/{id}', 'Admin\CouponController@edit');
        Route::get('view-coupon/{id}', 'Admin\CouponController@view');
        Route::delete('delete-coupon/{id}', 'Admin\CouponController@delete');
        Route::post('coupon-status/{id}', 'Admin\CouponController@status');

        # Content Management
        Route::get('content', 'Admin\ContentManagementController@index')->name('content');
        Route::get('add-content', 'Admin\ContentManagementController@create');
        Route::post('store-content', 'Admin\ContentManagementController@store');
        Route::get('edit-content/{id}', 'Admin\ContentManagementController@update');
        Route::post('edit-content/{id}', 'Admin\ContentManagementController@edit');
        Route::get('view-content/{id}', 'Admin\ContentManagementController@view');
        Route::get('delete-content/{id}', 'Admin\ContentManagementController@delete');
        Route::post('content-status/{id}', 'Admin\ContentManagementController@status'); 


        # Contact Us Management
        Route::get('contact-us', 'Admin\ContactUsController@index')->name('contact-us');
        // Route::get('add-contactus', 'Admin\ContactUsController@create');
        // Route::post('store-contactus', 'Admin\ContactUsController@store');
        // Route::get('edit-contactus/{id}', 'Admin\ContactUsController@update');
        // Route::post('edit-contactus/{id}', 'Admin\ContactUsController@edit');
        // Route::get('view-contactus/{id}', 'Admin\ContactUsController@view');
        // Route::get('delete-contactus/{id}', 'Admin\ContactUsController@delete');
        // Route::post('contactus-status/{id}', 'Admin\ContactUsController@status');

        # Rating And Review Management
        Route::get('rating-review', 'Admin\RatingReviewController@index')->name('rating-review');
        Route::post('rating-review-status/{id}', 'Admin\RatingReviewController@status');
        Route::get('view-rating/{id}', 'Admin\RatingReviewController@viewRating');
 
        # Variant
        Route::get('color', 'Admin\ColorController@index')->name('color');
        Route::get('add-color', 'Admin\ColorController@create');
        Route::post('store-color', 'Admin\ColorController@store');
        Route::get('edit-color/{id}', 'Admin\ColorController@update');
        Route::post('edit-color/{id}', 'Admin\ColorController@edit');
        Route::get('view-color/{id}', 'Admin\ColorController@view');
        Route::delete('delete-color/{id}', 'Admin\ColorController@delete');
        Route::post('color-status/{id}', 'Admin\ColorController@status');

        # product
        Route::get('product', 'Admin\ProductController@index')->name('product');
        Route::get('add-product', 'Admin\ProductController@create');
        Route::post('store-product', 'Admin\ProductController@store');
        Route::get('edit-product/{id}', 'Admin\ProductController@update');
        Route::post('edit-product', 'Admin\ProductController@edit');
        Route::get('view-product/{id}', 'Admin\ProductController@view');
        Route::delete('delete-product/{id}', 'Admin\ProductController@delete');
        Route::post('product-status/{id}', 'Admin\ProductController@status');
        Route::post('product-featured-status/{id}', 'Admin\ProductController@featuredStatus');
     
        # Settings
        // Route::get('setting', 'Admin\SettingsgController@index')->name('setting');
        Route::get('setting', 'Admin\SettingController@settings')->name('setting');
        Route::get('add-setting', 'Admin\SettingController@create');
        Route::post('store-setting', 'Admin\SettingController@store');
        Route::get('edit-setting/{id}', 'Admin\SettingController@update');
        Route::post('edit-setting/{id}', 'Admin\SettingController@edit');
        Route::get('view-setting/{id}', 'Admin\SettingController@view');
        Route::get('delete-setting/{id}', 'Admin\SettingController@delete');
        Route::post('setting-status/{id}', 'Admin\SettingController@status');
        Route::post('/save-settings', 'Admin\SettingController@saveSettings')->name('save-settings'); 

        # Social Media
        // Route::post('socialmedia', 'Admin\SettingController@socialMedia')->name('socialmedia');
        
        # Logo and Favicon
        // Route::post('logo-favicon', 'Admin\SettingController@logoAndFavicon')->name('logo-favicon');

        # Stock Management
        Route::get('stock', 'Admin\StockController@index')->name('stock');
        // Route::get('add-stock', 'Admin\StockController@create');
        // Route::post('store-stock', 'Admin\StockController@store');
        Route::get('edit-stock/{id}', 'Admin\StockController@update');
        Route::post('edit-stock/{id}', 'Admin\StockController@edit');
        // Route::get('view-stock/{id}', 'Admin\StockController@view');
        // Route::delete('delete-stock/{id}', 'Admin\StockController@delete');
        Route::post('stock-status/{id}', 'Admin\StockController@status');

        // Route::get('recent-order', function () {
        //     return view('admin.order.recent-order');
        // });

        // order management
        Route::get('all-order', 'Admin\OrderManagementController@allOrder')->name('all-order');
        Route::get('recent-order', 'Admin\OrderManagementController@recentOrder')->name('recent-order');
        Route::get('complete-order', 'Admin\OrderManagementController@completeOrder')->name('complete-order');
        Route::get('edit-order/{id}', 'Admin\OrderManagementController@editOrder');
        Route::post('order-status/{id}', 'Admin\OrderManagementController@orderstatus');
        Route::get('view-order/{id}', 'Admin\OrderManagementController@view');



        # Report
        Route::get('reports', 'Admin\ReportController@repostList')->name('reports');
        Route::get('view-report/{id}', 'Admin\ReportController@viewReport');
        Route::post('delete-report','Admin\ReportController@delete');


        Route::get('payment', 'Admin\PaymentManagementController@payment')->name('payment');
        Route::get('view-payment/{id}', 'Admin\PaymentManagementController@viewPayment');

        Route::get('total-count', 'Admin\OrderManagementController@totalCount');


});  
    # Forgot Password Admin
    Route::get('admin/forgot-password', 'Admin\ForgotPasswordController@index')->name('forgot-password');
    Route::post('admin/forgot-password', 'Admin\ForgotPasswordController@forgotPasswordAdmin');
    Route::get('/admin/reset-password', 'Admin\ForgotPasswordController@resetPage');
    Route::post('/admin/reset-password', 'Admin\ForgotPasswordController@resetPasswordSubmit');

# End Admin Routes  

    
# Initiate website routes
Route::get('login', 'Website\UserController@loginPage');      
Route::post('login-submit', 'Website\UserController@login');      
Route::get('/about-us', 'Website\HomeController@contentMangement');
Route::get('contact-us', 'Website\SettingControlloer@index');
Route::get('/categoryMenu', 'Website\CategoryController@categoryMenu');
Route::post('/delete-address','Website\UserProfileController@delete');
Route::get('json-city', 'Website\UserProfileController@jsonCities')->name('json-city');
Route::get('/search-product','Website\SearchController@index');
// Route::get('order-detail/{id}', 'Website\UserProfileController@orderDetail');


# Website middleware
Route::group(['middleware' => 'web-user'], function() 
{ 
    Route::any('add-to-cart', 'Website\OrderController@addToCart');
    Route::any('add-cart', 'Website\OrderController@addCartFromProductDetail');
    Route::post('add-cart-wish-list', 'Website\OrderController@addCartFromWishList');
    Route::post('remove-to-cart', 'Website\OrderController@removeToCart');
    Route::post('add-to-wishlist', 'Website\OrderController@wishList');
    Route::post('add-wishlist', 'Website\OrderController@addWishList');
    Route::post('remove-wishlist', 'Website\OrderController@removeWishList');
    Route::get('user-logout', 'Website\UserController@logout'); 

    # User Profile
    Route::get('user-profile', 'Website\UserProfileController@index'); 
    Route::get('user-address', 'Website\UserProfileController@create'); 
    Route::post('add-address', 'Website\UserProfileController@storeAddress'); 
    Route::get('edit-profile/{id}', 'Website\UserProfileController@update'); 
    Route::post('edit-address/{id}', 'Website\UserProfileController@editAddress'); 
    Route::post('forgot-password/{id}', 'Website\UserProfileController@forgotPassword'); 

    Route::get('cart', 'Website\OrderController@viewCart');
    // Route::get('count-cart', 'Website\OrderController@count');

    Route::get('remove-from-cart/{slug}', 'Website\OrderController@removeItemFromCart');

    Route::get('change-cart-count/{cartId}/{slug}/{type}', 'Website\OrderController@increaseDecreaseCartItem');
    
    Route::get('/checkout', 'Website\OrderController@checkout');

    Route::get('stripe', 'Website\OrderController@stripe');
    
    Route::post('stripe', 'Website\OrderController@stripePost')->name('stripe.post');

    Route::get('/order-address/{id}', 'Website\UserProfileController@address');
    Route::get('order-detail/{id}', 'Website\UserProfileController@orderDetail');
    Route::get('rating/{id}/{orderId}', 'Website\UserProfileController@addRating');
    Route::post('add-rating/{id}/{orderId}', 'Website\UserProfileController@reviewAndRating');



});     
    # user Forgot Password
    Route::any('/password-submit', 'Website\UserController@forgot');
    Route::any('/forgot-password', 'Website\UserController@forgotPass');
    Route::get('/reset-password', 'Website\UserController@resetPasswordVerify');
    Route::post('/reset-password-submit', 'Website\UserController@resetPasswordSubmit');

Route::get('/payment-success', function () {
    return view('website.cart-checkout-vendor.payment-success');
});


// Route::get('/wishlist', function () {   
//     return view('website.cart-checkout-vendor.wishlist');
// });

Route::get('/vendor-profile', function () {
    return view('website.cart-checkout-vendor.vendor-profile');
});

Route::get('/vendor-dashboard', function () {
    return view('website.cart-checkout-vendor.vendor-dashboard');
});

Route::get('/become-vendor', function () {
    return view('website.cart-checkout-vendor.become-vendor');
});

// Route::get('/forget-password', function () { 
//     return view('website.auth.forget-password');
// });


// Order Success
Route::get('/order-success', function () { 
    return view('website.order-success');
});


// Route::get('/reset-password', function () {
//     return view('website.auth.reset-password');
// });


// Website Setting
 
// Route::get('/email_verification', function () { 
//     return view('website.email.email_verification');
// });


// Cart




// Admin Panel

Route::get('/admin2', function () {
    return view('admin.admin2');
});



// admin forgot password
// Route::get('/admin/forgot-password', function () {
//     return view('admin.auth.forgot');
// });

// admin reset password
// Route::get('/admin/reset-password', function () {
//     return view('admin.auth.reset');
// });

Route::get('admin/scheduled-order', function () { 
    return view('admin.order.Scheduled-order');
});
Route::get('admin/returned-order', function () {
    return view('admin.order.returned-order');
});

// order delivery management
Route::get('admin/order-delivery', function () {
    return view('admin.order-delivery.index');
});

// discount management  
Route::get('admin/discount', function () {
    return view('admin.discount.index');
});

Route::get('admin/refund-return', function () {
    return view('admin.payment.refund');
});
// notification management
Route::get('admin/notification', function () {
    return view('admin.notification.index');
});
    
    
//Theme font management
Route::get('admin/theme-font', function () {
    return view('admin.theme-font.index');
});

