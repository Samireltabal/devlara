<?php

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

// Main Route ( Home Page )
Route::get('/', 'HomeController@index')->name('dashboard');

// Authentication Routes 
Auth::routes();
// Change Language
Route::put('lang', 'HomeController@lang')->name('lang');

// MiddleWare Web 

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/sn','HomeController@sn')->name('sn.check');

Route::get('/dashboard', 'AdminController@index')->name('admin');

Route::group(['prefix' => 'shifts', 'middleware' => ['auth','role:admin']], function() {
    Route::get('/','ShiftsController@index')->name('shifts.main');
    Route::post('/create','ShiftsController@create')->name('shifts.create');

});
Route::group(['prefix' => 'expenses' , 'middleware' => ['auth', 'role:admin']], function() {
    Route::get('/list','InterfaceController@expdest_ac')->name('expdest.list');
    Route::post('/create','InterfaceController@addExpdense')->name('expense.create');
});
Route::group(['prefix' => 'suppliers', 'middleware' => ['auth','role:admin']], function() {
    Route::get('/','SuppliersController@index')->name('suppliers.main');
    Route::post('/create','SuppliersController@create')->name('suppliers.create');

});
Route::group(['prefix' => 'backup' , 'middleware' => ['auth', 'role:admin']], function() {
 // Backup routes
 Route::get('/', 'BackupController@index')->name('backup.main');
 Route::get('/create', 'BackupController@create');
 Route::get('/download/{file_name}', 'BackupController@download');
 Route::get('/delete/{file_name}', 'BackupController@delete');
});
Route::group(['prefix' => '/sales', 'middleware' => ['auth']], function() {
    Route::get('/','InterfaceController@index')->name('sales.main');
    Route::get('/invoice/{id}','InterfaceController@invoice_ajax')->name('sales.invoice.ajax');
    Route::post('/submit','InterfaceController@submit_item')->name('sales.submit');
    Route::get('/delete/{id}','InterfaceController@delete_item')->name('item_delete')->middleware(['auth', 'role:admin']);
    Route::post('/creteaInvoice','InterfaceController@create_invoice')->name('sales.createInvoice');
    Route::post('/invoiceRedirect','InterfaceController@invoice_redirect')->name('sales.invoiceRedirect');
    Route::post('/invoice/open','ShiftsController@openInvoice')->name('invoice.reopen');
    Route::get('/id/{id}','InterfaceController@invoice')->name('invoice.ID');
    Route::get('/customersList','InterfaceController@customersAC')->name('customers.ac');
    route::get('/productAC','InterfaceController@products_list')->name('sales.products.ac');
    route::get('/productbarcode','InterfaceController@barcode')->name('sales.barcode.ac');
    route::get('/closeInvoice/{id}','InterfaceController@toggleInvoice')->name('sales.toggle.invoice');
    route::get('/print/invoice/{id}','InterfaceController@print')->name('invoice.print');
    
});
Route::group(['prefix' => 'categories', 'middleware' => ['auth','role:admin']], function() {
    Route::get('/','CategoriesController@index')->name('categories.main');
    Route::get('/content','CategoriesController@showCategories')->name('categories.ajax');
    Route::post('/create','CategoriesController@create')->name('categories.create');
    Route::post('/edit','CategoriesController@edit')->name('categories.edit');
    Route::delete('/delete','CategoriesController@delete')->name('categories.delete');
});
Route::group(['prefix' => 'products', 'middleware' => ['auth','role:admin']], function() {
    Route::get('/','ProductsController@index')->name('products.main');
    Route::get('/content','ProductsController@show')->name('products.ajax');
    Route::post('/create','ProductsController@create')->name('products.create');
    Route::post('/edit','ProductsController@edit')->name('products.edit');
    Route::post('/toggle','ProductsController@toggle')->name('product.toggleState');
    Route::delete('/delete','ProductsController@delete')->name('products.delete');
});
Route::group(['prefix' => 'inventory', 'middleware' => ['auth','role:admin']], function() {
    Route::get('/','InventoryController@index')->name('inventory.main');
    Route::get('/content','InventoryController@show')->name('inventory.ajax');
    Route::post('/create','InventoryController@create')->name('inventory.create');
    Route::post('/edit','InventoryController@edit')->name('inventory.edit');
    Route::delete('/delete','InventoryController@delete')->name('inventory.delete');
    Route::get('/acsup','InventoryController@ac_suppliers')->name('inventory.supplier');
    Route::get('/acpro','InventoryController@ac_products')->name('inventory.product');

});
// Super Admin Area
    // Accounts
        Route::group(['prefix' => 'accounts', 'middleware' => ['auth','role:admin']], function() {
            // Prevent User From Deleting Or Suspending His Account
            Route::group(['middleware'=>'SecureYourSelf'], function() {
                Route::post('/toggle','AccountsController@toggle')->name('toggleState');
                Route::delete('/delete','AccountsController@delete')->name('deleteAccount');
                Route::put('/edit/{id}','AccountsController@update')->name('accounts.update');
                Route::get('/create','AccountsController@create')->name('accounts.create');
                Route::post('/addUser','AccountsController@doAdd')->name('accounts.createAdd');
                Route::get('/edit/{id}','AccountsController@Edit')->name('accounts.edit');
    
            });
            Route::get('/','AccountsController@index')->name('accounts.list');
            
        
            });

            Route::group(['middleware' => 'auth'], function(){
                Route::get('/profile','AccountsController@profile')->name('accounts.profile');
                Route::put('/password','AccountsController@changePassword')->name('accounts.password');
                Route::put('/profile','AccountsController@editProfile')->name('accounts.editProfile');

                
            });
            Route::group(['prefix'=> 'employee', 'middleware'=> ['auth','role:admin']], function(){
                route::get('/','EmployeesController@index')->name('emp.main');
                route::get('/attendance','EmployeesController@attendance')->name('emp.att');
                route::get('/list','EmployeesController@list_employees')->name('emp.list');
                route::post('/create','EmployeesController@create_employee')->name('emp.create');
                route::delete('/delete','EmployeesController@delete')->name('emp.delete');
                route::get('/attlist','EmployeesController@att_list')->name('emp.att.list');
                route::post('/attend','EmployeesController@attend')->name('emp.attend');
                route::get('/Entitlements/id/{id}','EmployeesController@getEntitlements')->name('emp.entitlements');
                route::post('/Entitlements/Add/{id}','EmployeesController@AddEntitlements')->name('emp.add.entitlements');
            });

            Route::group(['prefix' => 'reports' , 'middleware' => ['auth','role:admin']], function(){
                route::get('/','ReportsController@index')->name('reports.all');
                route::get('/main','ReportsController@total')->name('reports.total');
                route::get('/totalsJson','ReportsController@totalsJson')->name('reports.totals');
                route::get('/todayJson','ReportsController@todayJson')->name('reports.today.json');
                route::get('/today','ReportsController@today')->name('reports.today');
                route::get('/todayjson','ReportsController@full_report')->name('today.json');
                route::get('/month','ReportsController@month')->name('reports.monthly');
                route::get('/monthjson','ReportsController@monthJson')->name('reports.monthly.json');
                route::get('/year','ReportsController@year')->name('reports.yearly');
                route::get('/custom','ReportsController@custom')->name('reports.custom');
                route::get('/date/{date1}/{date2}','ReportsController@date')->name('reports.date');
                route::get('/product/{id}','ReportsController@product')->name('reports.product');

            });

            // Route::group( ['prefix'=>'installer' , 'middleware' => ['web']], function(){
            //     route::get('/','installerController@index');
            //     route::get('/products','installerController@product_migration');
            //     route::get('/shifts','installerController@shifts');
            //     route::get('/items','itemInstaller@items');
            //     route::get('/items/2','itemInstaller2@items2');
            //     route::get('/items/3','itemInstaller3@items3');
            // });