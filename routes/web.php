<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\WishlishtController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AmenitieController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FaqRentController;
use App\Http\Controllers\Admin\OurPertnerController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\WhyChooseController;
use App\Http\Controllers\Admin\FindSellingController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\StripePaymentController;
use App\Http\Controllers\Admin\HowWeWorkController;
use App\Http\Controllers\Admin\UserPackageController;
use App\Http\Controllers\Admin\GetYourDreamController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/login', function () {
    return redirect('/');
});

 
Route::get('/',[FrontendController::class,'index'])->name('home');

Route::post('user_register',[LoginController::class,'userRegister'])->name('user_register');
Route::post('user_login',[LoginController::class,'userLogin'])->name('user_login');

//foregtpassword
Route::post('foregt-password',[LoginController::class,'foregtPassword'])->name('foregt-password');
Route::get('/forget/password/{id}/{token_no}', [LoginController::class,'foregtPasswordCreate'])->name('/forget/password');
Route::post('/forget/password/update', [LoginController::class,'foregtPasswordUpdate'])->name('/forget/password/update');

Route::get('/about',[FrontendController::class,'about'])->name('about');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::get('/details/{id}',[FrontendController::class,'details'])->name('details');
Route::get('/faq',[FrontendController::class,'faq'])->name('faq');
Route::get('/howwework',[FrontendController::class,'howwework'])->name('howwework');
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/cities-listing',[FrontendController::class,'citiesListing'])->name('cities-listing');
Route::get('/blog-details/{slug}',[FrontendController::class,'blogDetails'])->name('blog-details');

Route::post('/property-listing',[FrontendController::class,'propertyListing'])->name('property-listing');

Route::get('categorye-filter',[FrontendController::class,'categoryeFilter'])->name('categorye-filter');
Route::get('filter_rent_type',[FrontendController::class,'filterRentType'])->name('filter_rent_type');
Route::get('/product-filter',[FrontendController::class,'autocomplete'])->name('product-filter');


//get in touch
Route::post('get-in-touch',[ContactController::class,'getInTouch'])->name('get-in-touch');


Route::group(['middleware' => ['auth:web']], function() {
    Route::get('/sell',[FrontendController::class,'sell'])->name('sell');
    Route::get('/my-property',[FrontendController::class,'myproperty'])->name('my-property');
    Route::get('/my-favorites',[FrontendController::class,'myfavorites'])->name('my-favorites');
    Route::get('/saved-search',[FrontendController::class,'savedsearch'])->name('saved-search');
    Route::get('/my-profile',[FrontendController::class,'myprofile'])->name('my-profile');
    Route::get('/change-password',[FrontendController::class,'myaccount'])->name('my-account');

    //profiel update
    Route::post('/profile/update',[FrontendController::class,'profileUpdate'])->name('/profile/update');
    Route::post('/profile/changepassword',[FrontendController::class,'profileChangepassword'])->name('/profile/changepassword');

    //country state 
    Route::post('/front/getstate',[FrontendController::class,'getstate'])->name('/front/getstate');
    Route::post('/front/getcity',[FrontendController::class,'getcity'])->name('/front/getcity');

    //add to wishlisht
    Route::get('/add-To-wishlisht',[WishlishtController::class,'addToWishlisht'])->name('/add-To-wishlisht');
    Route::get('/delete-to-wishlisht',[WishlishtController::class,'wishlishtDeleted'])->name('delete-to-wishlisht');

    Route::get('logout',[LoginController::class,'logout'])->name('user.logout');


    //property created
    Route::post('property-created',[FrontendController::class,'propertyCreated'])->name('property-created');
    Route::get('property/edit/{id}',[FrontendController::class,'propertyEdit']);
    Route::post('property-delete-user',[FrontendController::class,'propertyDelete'])->name('property-delete-user');
    Route::post('front/property/image/remove',[FrontendController::class,'propertyRemoveImage'])->name('/front/property/image/remove');
    Route::post('fornt-property-update',[FrontendController::class,'frontPropertyUpdate'])->name('front-property-update');

    Route::get('/event/search/data',[FrontendController::class,'eventSearch'])->name('/event/search/data');
    Route::get('/sort-by',[FrontendController::class,'sort_by'])->name('sort.by');

    Route::get('/advertisment-list',[FrontendController::class,'advertismentList'])->name('advertisment-list');
    Route::get('/add-addvertisement',[FrontendController::class,'addAddvertisement'])->name('add-addvertisement');
    Route::post('/save-addvertisement',[FrontendController::class,'saveAddvertisement'])->name('save-addvertisement');
    
    //paymentroutefree
    Route::get('basicpackageby',[StripePaymentController::class,'basicPackageBy'])->name('/basicpackageby');
    
    //payment buy price
    Route::get('stripe_payment/{id}',[StripePaymentController::class,'stripe'])->name('stripe_payment');
    Route::post('stripesave',[StripePaymentController::class,'stripePost'])->name('stripe.post');

});

Route::get('admin/login',[AdminController::class,'adminLogin'])->name('admin/login');
Route::post('/authenticated',[AdminController::class,'authenticate'])->name('admin.authenticate');


// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('stripe', 'stripe');
//     Route::post('stripe', 'stripePost')->name('stripe.post');
// });

Route::group(['prefix' => 'admin', 'middleware' => ['is_Admin']], function () {
    
    //addmin route
    Route::get('logout',[DashBoardController::class,'logout'])->name('admin.logout');
    Route::get('dashboard',[DashBoardController::class,'index'])->name('admin.dashboard');
    
   
    //user route
    Route::get('user-list',[UserController::class,'index'])->name('user.index');
    Route::match(['get','post'],'/usercreate',[UserController::class,'create'])->name('user.create');
    Route::get('user/edit/{id}',[UserController::class,'userEdit']);
    Route::post('user-update',[UserController::class,'userUpdate'])->name('user-update');
    Route::post('user-delete',[UserController::class,'userDelete'])->name('user-delete');
    Route::post('user-status',[UserController::class,'userStatus'])->name('user-status');

    //role master
    Route::get('roles-list',[RoleController::class,'index'])->name('roles.index');
    Route::match(['get','post'],'/role-create',[RoleController::class,'create'])->name('role.create');
    Route::get('role/edit/{id}',[RoleController::class,'roleEdit']);
    Route::post('roles-update',[RoleController::class,'roleUpdate'])->name('role-update');
    Route::post('role-delete',[RoleController::class,'roleDelete'])->name('role-delete');
    Route::post('role-status',[RoleController::class,'rolesStatus'])->name('role-status');

    //role permission
    Route::get('/roles/permission/{id}',[RoleController::class,'getAddPermissionPage'])->name('/roles/permission');
    Route::post('/roles/permission/update',[RoleController::class,'addPermission'])->name('roles/permission/update');

    //user manage role
    Route::get('user-roles-list',[UserManageController::class,'index'])->name('user-roles.index');
    Route::match(['get','post'],'/user-role-create',[UserManageController::class,'userCreate'])->name('user-role-create');
    Route::get('user/role/edit/{id}',[UserManageController::class,'userRoleEdit']);
    Route::post('user-roles-update',[UserManageController::class,'userRoleUpdate'])->name('user-role-update');
    Route::post('user-role-delete',[UserManageController::class,'userRoleDelete'])->name('user-role-delete');
    Route::post('user-role-status',[UserManageController::class,'userRolesStatus'])->name('user-role-status');

    //banners route
    Route::get('banner-list',[BannerController::class,'index'])->name('banners.index');
    Route::match(['get','post'],'/banner-create',[BannerController::class,'create'])->name('banner-create');
    Route::get('banner/edit/{id}',[BannerController::class,'bannerEdit']);
    Route::post('banner-update',[BannerController::class,'bannerUpdate'])->name('banner-update');
    Route::post('banner-delete',[BannerController::class,'bannerDelete'])->name('banner-delete');
    Route::post('banner-status',[BannerController::class,'bannersStatus'])->name('banner-status');

    //blogs route
    Route::get('blogs-list',[BlogController::class,'index'])->name('blogs.index');
    Route::match(['get','post'],'/blogs-create',[BlogController::class,'create'])->name('blogs-create');
    Route::get('blogs/edit/{id}',[BlogController::class,'blogEdit']);
    Route::post('blogs-update',[BlogController::class,'blogsUpdate'])->name('blogs-update');
    Route::post('blog-delete',[BlogController::class,'blogDelete'])->name('blog-delete');
    Route::post('blog-status',[BlogController::class,'blogStatus'])->name('blog-status');

    //category route
    Route::get('categoryes',[CategoryController::class,'index'])->name('categoryes.index');
    Route::match(['get','post'],'/categoryes-create',[CategoryController::class,'create'])->name('categoryes-create');
    Route::get('categoryes/edit/{id}',[CategoryController::class,'categoryeEdit']);
    Route::post('categoryes-update',[CategoryController::class,'categoryesUpdate'])->name('categoryes-update');
    Route::post('categoryes-delete',[CategoryController::class,'categoryesDelete'])->name('categoryes-delete');
    Route::post('categoryes-status',[CategoryController::class,'categoryesStatus'])->name('categoryes-status');

    //aminities route
    Route::get('aminities',[AmenitieController::class,'index'])->name('aminities.index');
    Route::match(['get','post'],'/aminities-create',[AmenitieController::class,'create'])->name('aminities-create');
    Route::get('aminities/edit/{id}',[AmenitieController::class,'aminitiesEdit']);
    Route::post('aminities-update',[AmenitieController::class,'aminitiesUpdate'])->name('aminities-update');
    Route::post('aminities-delete',[AmenitieController::class,'aminitiesDelete'])->name('aminities-delete');
    Route::post('aminities-status',[AmenitieController::class,'aminitiesStatus'])->name('aminities-status');

    //property created
    Route::get('property',[PropertyController::class,'index'])->name('property.index');
    Route::get('property-create',[PropertyController::class,'propertyCreate'])->name('property-create');
    Route::post('property-save',[PropertyController::class,'propertySave'])->name('property-save');
    Route::get('property/edit/{id}',[PropertyController::class,'propertyEdit']);
    Route::post('property-update',[PropertyController::class,'propertyUpdate'])->name('property-update');
    Route::post('property-delete',[PropertyController::class,'propertyDelete'])->name('property-delete');
    Route::post('property-status',[PropertyController::class,'propertyStatus'])->name('property-status');
    Route::post('/property/image/remove',[PropertyController::class,'removeImage'])->name('/property/image/remove');
    Route::post('featured-status',[PropertyController::class,'featuredStatus'])->name('featured-status');

     //country state 
    Route::post('/customers/getstate',[PropertyController::class,'getstate'])->name('/customers/getstate');
    Route::post('/customers/getcity',[PropertyController::class,'getcity'])->name('/customers/getcity');

     // cms route
    Route::get('cms',[CmsController::class,'index'])->name('cms.index');
    Route::match(['get','post'],'/cms-create',[CmsController::class,'cmsCreate'])->name('cms-create');
    Route::get('cms/edit/{id}',[CmsController::class,'cmsEdit']);
    Route::post('cms-update',[CmsController::class,'cmsUpdate'])->name('cms-update');
    Route::post('cms-delete',[CmsController::class,'cmsDelete'])->name('cms-delete');
    Route::post('cms-status',[CmsController::class,'cmsStatus'])->name('cms-status');

    // contact front
    Route::get('contact-user',[ContactUsController::class,'index'])->name('contact.index');
    Route::get('contact-view/edit/{id}',[ContactUsController::class,'contactView']);
    Route::post('contact-Delete',[ContactUsController::class,'contactDelete'])->name('contact-delete');

    //about us route
    Route::get('about-listing',[AboutController::class,'index'])->name('about-listing');
    Route::match(['get','post'],'/about-create',[AboutController::class,'create'])->name('about-create');
    Route::get('about/edit/{id}',[AboutController::class,'aboutEdit']);
    Route::post('about-update',[AboutController::class,'aboutUpdate'])->name('about-update');
    Route::post('about-delete',[AboutController::class,'aboutDelete'])->name('about-delete');
    Route::post('about-status',[AboutController::class,'aboutStatus'])->name('about-status');

    // faq route
    Route::get('faq',[FaqController::class,'index'])->name('faq.index');
    Route::match(['get','post'],'/faq-create',[FaqController::class,'create'])->name('faq-create');
    Route::get('faq/edit/{id}',[FaqController::class,'faqEdit']);
    Route::post('faq-update',[FaqController::class,'fqaUpdate'])->name('faq-update');
    Route::post('faq-delete',[FaqController::class,'fqaDelete'])->name('faq-delete');
    Route::post('faq-status',[FaqController::class,'faqStatus'])->name('faq-status');

    // faq Rents route
     // faq route
     Route::get('faq-rent',[FaqRentController::class,'index'])->name('faq-rent.index');
     Route::match(['get','post'],'/faq-rent-create',[FaqRentController::class,'create'])->name('faq-rent-create');
     Route::get('faq-rent/edit/{id}',[FaqRentController::class,'faqrentEdit']);
     Route::post('faq-rent-update',[FaqRentController::class,'fqaUpdate'])->name('faq-rent-update');
     Route::post('faq-rent-delete',[FaqRentController::class,'faqrentDelete'])->name('faq-rent-delete');
     Route::post('faq-rent-status',[FaqRentController::class,'faqStatus'])->name('faq-rent-status');

     //our pertners
     Route::get('oure-pertner-list',[OurPertnerController::class,'index'])->name('oure-pertner.index');
     Route::match(['get','post'],'/oure-pertner-create',[OurPertnerController::class,'create'])->name('oure-pertner-create');
     Route::get('oure-pertner/edit/{id}',[OurPertnerController::class,'ourePertnerEdit']);
     Route::post('pertner-update',[OurPertnerController::class,'ourePertnerUpdate'])->name('pertner-update');
     Route::post('pertner-delete',[OurPertnerController::class,'pertnerDelete'])->name('pertner-delete');
     Route::post('pertner-status',[OurPertnerController::class,'pertnerStatus'])->name('pertner-status');


      //property cities
    Route::get('cities-list',[CitiesController::class,'index'])->name('cities.index');
    Route::match(['get','post'],'/cities-create',[CitiesController::class,'create'])->name('cities-create');
    Route::get('cities/edit/{id}',[CitiesController::class,'citiesEdit']);
    Route::post('cities-update',[CitiesController::class,'citiesUpdate'])->name('cities-update');
    Route::post('cities-delete',[CitiesController::class,'citiesDelete'])->name('cities-delete');
    Route::post('cities-status',[CitiesController::class,'citiesStatus'])->name('cities-status');

    //why choose us
    Route::get('why-choose-list',[WhyChooseController::class,'index'])->name('why-choose.index');
    Route::match(['get','post'],'/why-choose-create',[WhyChooseController::class,'create'])->name('why-choose-create');
    Route::get('why-choose/edit/{id}',[WhyChooseController::class,'whyChooseEdit']);
    Route::post('why-choose-update',[WhyChooseController::class,'whyChooseUpdate'])->name('why-choose-update');
    Route::post('why-choose-delete',[WhyChooseController::class,'whyChooseDelete'])->name('why-choose-delete');
    Route::post('why-choose-status',[WhyChooseController::class,'whyChooseStatus'])->name('why-choose-status');

    Route::post('deleted_why_chosse',[WhyChooseController::class,'deletedWhyChosse'])->name('deleted_why_chosse');

    // find sellings route
     //why choose us
     Route::get('find-sell-list',[FindSellingController::class,'index'])->name('find-sell.index');
     Route::match(['get','post'],'/find-sell-create',[FindSellingController::class,'create'])->name('find-sell-create');
     Route::get('find-sell/edit/{id}',[FindSellingController::class,'findSellEdit']);
     Route::post('find-sell-update',[FindSellingController::class,'findSellUpdate'])->name('find-sell-update');
     Route::post('find-sell-delete',[FindSellingController::class,'findSellDelete'])->name('find-sell-delete');
     Route::post('find-sell-status',[FindSellingController::class,'findSellStatus'])->name('find-sell-status');
 
     Route::post('deleted_find_sell',[FindSellingController::class,'findSellDelete'])->name('deleted_find_sell');

     //address route
      //property cities
    Route::get('address-list',[AddressController::class,'index'])->name('address.index');
    Route::match(['get','post'],'/address-create',[AddressController::class,'create'])->name('address-create');
    Route::get('address/edit/{id}',[AddressController::class,'addressEdit']);
    Route::post('address-update',[AddressController::class,'addressUpdate'])->name('address-update');
    Route::post('address-delete',[AddressController::class,'addressDelete'])->name('address-delete');
    Route::post('address-status',[AddressController::class,'addressStatus'])->name('address-status');

    // package route
    Route::get('package-list',[PackageController::class,'index'])->name('package.index');
    Route::match(['get','post'],'/package-create',[PackageController::class,'create'])->name('package-create');
    Route::get('package/edit/{id}',[PackageController::class,'packageEdit']);
    Route::post('package-update',[PackageController::class,'packageUpdate'])->name('package-update');
    Route::post('package-delete',[PackageController::class,'packageDelete'])->name('package-delete');
    Route::post('package-status',[PackageController::class,'packageStatus'])->name('package-status');

    // how we works 
    Route::get('how-work-list',[HowWeWorkController::class,'index'])->name('howwork.index');
    Route::match(['get','post'],'/how-work-create',[HowWeWorkController::class,'create'])->name('how-work-create');
    Route::get('how-work/edit/{id}',[HowWeWorkController::class,'howWorkEdit']);
    Route::post('how-work-update',[HowWeWorkController::class,'howWorkUpdate'])->name('howWork-update');
    Route::post('how-work-delete',[HowWeWorkController::class,'howWorkDelete'])->name('howWork-delete');
    Route::post('how-work-status',[HowWeWorkController::class,'howWorkStatus'])->name('howWork-status');

    //user Package manages
    Route::get('user-package-list',[UserPackageController::class,'index'])->name('userspackage.index');

    // get your dream route
    Route::get('get-your-dream-list',[GetYourDreamController::class,'index'])->name('getyourdream.index');
    Route::match(['get','post'],'/get-your-dream-create',[GetYourDreamController::class,'create'])->name('get-your-dream-create');
    Route::get('get-your-dream/edit/{id}',[GetYourDreamController::class,'getYourDreamEdit']);
    Route::post('get-your-dream-update',[GetYourDreamController::class,'getYourDreamUpdate'])->name('getYourDream-update');
    Route::post('get-your-dream-delete',[GetYourDreamController::class,'getYourDreamDelete'])->name('getYourDream-delete');
    Route::post('get-your-dream-status',[GetYourDreamController::class,'getYourDreamStatus'])->name('getYourDream-status');

});

Route::get('{slug}', [CmsController::class, 'fetch'])->name('cms.data.fetch');




