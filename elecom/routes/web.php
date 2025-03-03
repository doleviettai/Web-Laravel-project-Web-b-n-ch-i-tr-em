<?php

use App\Http\Controllers\Customer\CustomerProductCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\MasterSubcategoryController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Customer\CustomerProductController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'rolemanager:customer'])->name('customer.dashboard');

// Route::get('/admin/dashboard', function () {
//     return view('admin.admin');
// })->middleware(['auth', 'verified' , 'rolemanager:admin'])->name('admin');

// Route::get('/vendor/dashboard', function () {
//     return view('vendor');
// })->middleware(['auth', 'verified', 'rolemanager:vendor'])->name('vendor');



// admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::put('/profile/edit_img/{id}', 'edit_admin_img')->name('admin.setting.edit_img');

            Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
            Route::get('/manage/stores', 'manage_stores')->name('admin.manage.store');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create', 'index')->name('category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/subcategory/create', 'index')->name('subcategory.create');
            Route::get('/subcategory/manage', 'manage')->name('subcategory.manage');
        });

        Route::controller(ProductAttributeController::class)->group(function () {
            Route::get('/productattribute/create', 'index')->name('productattribute.create');
            Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');

            Route::post('/defaultattribute/create', 'createattribute')->name('attribute.create');
            Route::get('/defaultattribute/{id}', 'showattribute')->name('show.attribute');
            Route::put('/defaultattribute/update/{id}', 'updateattribute')->name('update.attribute');
            Route::delete('/defaultattribute/delete/{id}', 'deleteattribute')->name('delete.attribute');
            Route::post('/defaultattribute/search', 'searchattribute')->name('search.attribute'); // tìm kiếm ajax phải tìm phương thức post
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/manage', 'index')->name('product.manage');
            Route::post('/product/search', 'productsearch')->name('product.search');
            Route::get('/product/create', 'productcreate')->name('product.create');
            Route::post('/product/insert', 'productinsert')->name('product.insert');
            Route::delete('/product/delete/{id}', 'productdelete')->name('product.delete');
            Route::get('/product/{id}', 'productedit')->name('product.edit');
            Route::put('/product/update/{id}', 'productupdate')->name('product.update');

            Route::get('/product/review/manage', 'review_manage')->name('product.review.manage');
            Route::post('/product/review/search', 'review_search')->name('product.review.search');
            Route::get('/product/review/create', 'review_manage_order')->name('product.review.create');
            Route::post('/product/review/insert_item_order', 'review_insert_item_order')->name('product.review.insert_item_order');
            Route::delete('/product/review/delete_item_order/{id}', 'review_delete_item_order')->name('product.review.delete_item_order');
            Route::delete('/product/review/truncate_order', 'review_truncate_order')->name('product.review.truncate_order');
            Route::get('/product/review/createorder', 'review_create_order')->name('product.review.create_order');
            Route::post('/product/review/inserorder', 'review_insert_order')->name('product.review.insert_order');
        });

        Route::controller(UserManageController::class)->group(function () {
            Route::get('/client/manage', 'clientmanage')->name('client.manage');
            Route::post('/client/search', 'clientsearch')->name('client.search');
            Route::get('/client/{id}', 'showclient')->name('show.client');
            Route::put('/client/updateimg/{id}', 'updateimgclient')->name('updateimg.client');

            Route::get('/vendor/manage', 'vendormanage')->name('vendor.manage');
            Route::post('/vendor/search', 'vendorsearch')->name('vendor.search');
            Route::get('/vendor/create', 'createvendor')->name('vendor.create');
            Route::post('/vendor/insert', 'insertvendor')->name('vendor.insert');
            Route::delete('/vendor/delete/{id}', 'deletevendor')->name('vendor.delete');
            Route::get('/vendor/{id}', 'vendoredit')->name('vendor.edit');
            Route::put('/vendor/update/{id}', 'vendorupdate')->name('vendor.update');
        });

        Route::controller(HistoryController::class)->group(function () {
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history');
            Route::post('/cart/search', 'cart_search')->name('admin.cart.search');
            Route::get('/print_pdf/admin/{id}' , 'cart_photos_pdf')->name('admin.cart.print_pdf');
            Route::delete('/cart/delete/{id}', 'cart_delete')->name('admin.cart.delete');

            Route::get('/order/history', 'order_history')->name('admin.order.history');
            Route::post('/order/search', 'order_search')->name('admin.order.search');
            Route::delete('/order/delete/{id}', 'order_delete')->name('admin.order.delete');
            Route::get('/order/{id}', 'order_edit')->name('admin.order.edit');
            Route::put('/order/update/{id}', 'order_update')->name('admin.order.update');
            Route::get('/order/insertship/{id}', 'order_insertship')->name('admin.order.insertship');
            Route::post('/order/createship', 'order_createship')->name('admin.order.createship');
        });



        //=============================================================================================================
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::post('/store/category', 'storecat')->name('store.cat');
            Route::get('/category/{id}', 'showcat')->name('show.cat');
            Route::put('/category/update/{id}', 'updatecat')->name('update.cat');
            Route::delete('/category/delete/{id}', 'deletecat')->name('delete.cat');
            Route::post('/category/search', 'searchcat')->name('search.cat'); // tìm kiếm ajax phải tìm phương thức post
        });

        Route::controller(MasterSubcategoryController::class)->group(function () {
            Route::post('/store/subcategory', 'storesubcat')->name('store.subcat');
            Route::get('/subcategory/{id}', 'showsubcat')->name('show.subcat');
            Route::put('/subcategory/update/{id}', 'updatesubcat')->name('update.subcat');
            Route::delete('/subcategory/delete/{id}', 'deletesubcat')->name('delete.subcat');
            Route::post('/subcategory/search', 'searchsubcat')->name('search.subcat'); // tìm kiếm ajax phải tìm phương thức post
        });
    });
})->name('admin');



//Seller route
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function () {

    Route::prefix('vendor')->group(function () {
        Route::controller(SellerMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('vendor');
            Route::get('/profile/history', 'orderhistory')->name('vendor.order.history');
            Route::put('/profile/edit_img/{id}', 'edit_img')->name('vendor.order.edit_img');
        });

        Route::controller(SellerProductController::class)->group(function () {
            Route::get('/product/manage', 'index')->name('vendor.product.manage');
            Route::post('/product/search', 'productsearch')->name('vendor.product.search');

            Route::get('/product/manage_review', 'manage')->name('vendor.product.manage_review');
            Route::post('/product/review/search', 'review_search')->name('vendor.review.search');
            Route::get('/product/review/create', 'review_manage_order')->name('vendor.review.create');
            Route::post('/product/review/insert_item_order', 'review_insert_item_order')->name('vendor.review.insert_item_order');
            Route::delete('/product/review/delete_item_order/{id}', 'review_delete_item_order')->name('vendor.review.delete_item_order');
            Route::delete('/product/review/truncate_order', 'review_truncate_order')->name('vendor.review.truncate_order');
            Route::get('/product/review/createorder', 'review_create_order')->name('vendor.review.create_order');
            Route::post('/product/review/inserorder', 'review_insert_order')->name('vendor.review.insert_order');
        });

        Route::controller(SellerStoreController::class)->group(function () {
            Route::get('/store/ship', 'ship')->name('vendor.store.ship');
            Route::get('/print_pdf/seller/{id}' , 'cart_photos_pdf')->name('vendor.cart.print_pdf');
            Route::post('/store/search_order', 'cart_search')->name('vendor.cart.search');

            Route::get('/store/manage', 'manage')->name('vendor.store.manage');
            Route::post('/store/search', 'order_search')->name('vendor.order.search');
            Route::get('/store/{id}', 'order_edit')->name('vendor.order.edit');
            Route::put('/store/update/{id}', 'order_update')->name('vendor.order.update');
            Route::get('/store/insertship/{id}', 'order_insertship')->name('vendor.order.insertship');
            Route::post('/store/createship', 'order_createship')->name('vendor.order.createship');
        });
    });
})->name('vendor');



//Customer route
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function () {

    Route::prefix('customer')->group(function () {
        Route::controller(CustomerMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('customer.dashboard');
            Route::get('/introduce', 'introduce')->name('customer.introduce');
            Route::get('/setting/profile', 'profile')->name('customer.profile');
            Route::put('/setting/edit_profile/{id}', 'edit_profile')->name('customer.edit_profile');

            Route::get('/countcartpro/{id}' , 'countcartpro')->name('customer.count.procart');

            Route::get('/setting/list_order/{id}' , 'list_order')->name('customer.list.order');
            Route::delete('/setting/list_order/delete/{id}','delete_order_item')->name('customer.list.order.delete');
            Route::get('/setting/list_ship/{name}' , 'list_ship')->name('customer.list.ship');

            Route::get('/contact','contract')->name('customer.contact');
        });

        Route::controller(CustomerProductController::class)->group(function () {
            Route::get('/order/product', 'product')->name('customer.product');
            Route::post('/order/search_input', 'productsearch')->name('customer.product.search');
            Route::post('/order/search-0-100', 'productsearch_0_100')->name('customer.product.search_0_100');
            Route::post('/order/search-100-500', 'productsearch_100_500')->name('customer.product.search_100_500');
            Route::post('/order/search-500-1000', 'productsearch_500_1000')->name('customer.product.search_500_1000');
            Route::post('/order/search-1000-2000', 'productsearch_1000_2000')->name('customer.product.search_1000_2000');
            Route::post('/order/search-2000-5000', 'productsearch_2000_5000')->name('customer.product.search_2000_5000');
            Route::post('/order/search-5000-10tr', 'productsearch_5000_10tr')->name('customer.product.search_5000_10tr');

            Route::get('/order/see_product/{id}', 'product_see')->name('customer.product.see');
            Route::post('/order/see_product/createorder', 'product_create_order')->name('customer.product.createorder');
            Route::post('/order/see_product/insertorder', 'product_insert_order')->name('customer.product.insertorder');

            Route::post('/order/see_product/addtocart' , 'product_add_to_cart')->name('customer.product.add_to_cart');
        });

        Route::controller(CustomerProductCartController::class)->group(function () {
            Route::get('/cart/cartitem', 'cart')->name('customer.cart');
            Route::delete('/cart/delete/{id}','delete_cart_item')->name('customer.cart.delete');

            Route::post('/cart/see_cart/createorder', 'cart_create_order')->name('customer.cart.createorder');
            Route::post('/cart/see_cart/insertorder', 'cart_insert_order')->name('customer.cart.insertorder');
        });
    });
})->name('customer.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
