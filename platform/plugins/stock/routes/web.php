<?php

use Botble\Stock\Models\CPCategory;
use Botble\Stock\Models\Package;

Route::group(['namespace' => 'Botble\Stock\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(['prefix' => BaseHelper::getAdminPrefix() . '/stock', 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::resource('', 'CPCategoryController')
                ->parameters(['' => 'category']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'CPCategoryController@deletes',
                'permission' => 'category.destroy',
            ]);
        });

        Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
            Route::resource('', 'PackageController')
                ->parameters(['' => 'package']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'PackageController@deletes',
                'permission' => 'package.destroy',
            ]);
        });

        Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
            Route::resource('', 'ContractController')
                ->parameters(['' => 'contract']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ContractController@deletes',
                'permission' => 'contract.destroy',
            ]);
            //export word file
            Route::get('export-stock/{id}',[
               'as'=>'export-stock',
               'uses'=>'ContractController@exportStock'
            ]);
        
        });

        Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {

            Route::resource('', 'WithdrawController')
                ->parameters(['' => 'withdraw']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'WithdrawController@deletes',
                'permission' => 'withdraw.destroy',
            ]);
        });

        Route::group(['prefix' => 'cphistory', 'as' => 'cphistory.'], function () {
            Route::resource('', 'CPHistoryController')
                ->parameters(['' => 'cphistory']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'CPHistoryController@deletes',
                'permission' => 'cphistory.destroy',
            ]);
        });

        Route::group(['prefix' => 'chart', 'as' => 'chart.'], function () {
            Route::resource('', 'ChartController')
                ->parameters(['' => 'chart']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ChartController@deletes',
                'permission' => 'Chart.destroy',
            ]);
        });
    });
});

Route::group(['namespace' => 'Botble\Stock\Http\Controllers\Fronts', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        //get all cp_category
        Route::get('stock/cp-category', [
            'as' => 'public.cp-category',
            'uses' => 'StockController@stockCategory'
        ]);

       

        //get package by cp_category
        Route::get(SlugHelper::getPrefix(CPCategory::class, 'stock-category') . '/{slug}', [
            'as' => 'public.packages',
            'uses' => 'StockController@getPackageByCategory'
        ]);

        Route::group(['middleware' => 'customer'], function() {
            //create customer
            Route::get('stock/cp-create-customer/{phone}', [
                'as' => 'public.cp-create-customer',
                'uses' => 'StockController@createCustomer'
            ]);

            //create customer post
            Route::post('stock/cp-create-customer', [
                'as' => 'public.cp-create-customer.post',
                'uses' => 'StockController@postCreateCustomer'
            ]);

             //create Contract
             Route::get('stock/cp-create-contract/{phone}', [
                'as' => 'public.cp-create-contract',
                'uses' => 'StockController@createContract'
            ]);

            //create contract
            Route::post('stock/cp-create-contract', [
                'as' => 'public.cp-create-contract.post',
                'uses' => 'StockController@postCreateContract'
            ]);

            //customer click booking package
            Route::post('stock/book-package', [
                'as' => 'public.book-package.post',
                'uses' => 'StockController@bookPackage'
            ]);
             //view checkCustomer
            Route::get('stock/check-customer', [
                'as' => 'public.check-customer',
                'uses' => 'StockController@checkCustomer',
            ]);
            //preview booking package
            Route::get('stock/book-package/{code}', [
                'as' => 'public.book-package',
                'uses' => 'StockController@previewBookPackage',
            ]);

            // client confirm payment status = pending
            Route::post('stock/confirm-payment/{code}', [
                'as' => 'public.book-package.confirm_payment',
                'uses' => 'StockController@confirmPayment',
            ]);

            Route::post('stock/request-sign', [
                'as' => 'public.stock_request_sign',
                'uses' => 'StockController@requestSign',
            ]);

            //CP Dashboard
            Route::group(['prefix' => 'stock-manager', 'as' => 'stock-manager.'], function () {

                Route::group(['prefix' => 'ajax'], function () {
                    Route::group(['prefix' => 'chart', 'as' => 'chart.'], function () {
                        Route::get('month', [
                            'as'   => 'month',
                            'uses' => 'StockDashboardController@getMonthChart',
                        ]);
                    });

                    Route::get('get_contract_by_id', [
                        'as'   => 'getContractById',
                        'uses' => 'StockDashboardController@getContractById',
                    ]);
                });

                Route::get('dashboard', [
                    'as' => 'dashboard',
                    'uses' => 'StockDashboardController@getDashboard',
                ]);
                Route::get('contracts', [
                    'as' => 'contracts',
                    'uses' => 'ContractManagerController@getContract',
                ]);

                Route::get('contracts/{id}', [
                    'as' => 'contracts.detail',
                    'uses' => 'ContractManagerController@getContractDetail',
                ]);

                Route::group(['prefix' => 'withdrawals', 'as' => 'withdrawals.'], function () {

                    Route::get('index', [
                        'as' => 'index',
                        'uses' => 'StockWithdrawalController@index',
                    ]);

                    Route::post('index', [
                        'as' => 'index',
                        'uses' => 'StockWithdrawalController@index',
                    ]);

                    Route::get('create/{contract_id}', [
                        'as' => 'create',
                        'uses' => 'StockWithdrawalController@create',
                        'middleware' => 'not-trial-collaborator'
                    ]);

                    Route::post('create/{contract_id}', [
                        'as' => 'store',
                        'uses' => 'StockWithdrawalController@store',
                        'middleware' => 'not-trial-collaborator'
                    ]);

                    Route::get('edit/{id}', [
                        'as' => 'edit',
                        'uses' => 'StockWithdrawalController@edit',
                        'middleware' => 'not-trial-collaborator'
                    ]);

                    Route::post('update/{id}', [
                        'as' => 'update',
                        'uses' => 'StockWithdrawalController@update',
                        'middleware' => 'not-trial-collaborator'
                    ]);

                    Route::get('list-avaiable-contract', [
                        'as' => 'list-contract',
                        'uses' => 'StockWithdrawalController@listContract',
                        'middleware' => 'not-trial-collaborator'
                    ]);

                    Route::get('show/{id}', [
                        'as'   => 'show',
                        'uses' => 'StockWithdrawalController@show',
                        'middleware' => 'not-trial-collaborator'
                    ]);
                });

                Route::group(['prefix' => 'commission', 'as' => 'commission.'], function () {
                    Route::resource('', 'ContractCommissionController')->parameters(['' => 'commission'])->except(['create', 'store', 'update']);
                });

                Route::get('settings', [
                    'as' => 'settings',
                    'uses' => 'ContractManagerController@getSetting',
                ]);

                Route::post('settings', [
                    'as' => 'settings.post',
                    'uses' => 'ContractManagerController@saveSettings',
                ]);
            });
        });

        //ky hop dong
        Route::get('stock/sign-contract/{id}', [
            'as' => 'public.sign-contract',
            'uses' => 'StockController@registerContract'
        ]);

        Route::get('stock/frame-contract/{contract_number}/{contract_code}', [
            'as' => 'public.frame-contract.get',
            'uses' => 'StockController@getFrameFptContract'
        ]);

        //Qu???n l?? c??? ph???n
        Route::get('stock/cac-goi-co-phan', [
            'as' => 'stock.list-stocks',
            'uses' => 'StockController@getListStock'
        ]);

        //M??n h??nh th???ng k?? t??i s???n (dashboard)
        Route::get('stock/dashboard', [
            'as' => 'stock.dashboard',
            'uses' => 'StockController@dashboard',
            'middleware' => 'customer'
        ]);

        //m??n h??nh l???ch s??? tr??? l??i
        Route::get('stock/payment-history', [
            'as' => 'stock.payment-history',
            'uses' => 'StockController@paymentHistory',
            'middleware' => 'customer'
        ]);

        //M??n h??nh y??u c???u r??t ti???n
        Route::get('stock/withdraw', [
            'as' => 'stock.withdraw',
            'uses' => 'StockController@requestWithdraw',
            'middleware' => 'customer'
        ]);

        //m??n h??nh bi???u ????? t??ng tr?????ng
        Route::get('stock/growth-chart', [
            'as' => 'stock.growth-chart',
            'uses' => 'StockController@getChart'
        ]);
    });
});
