<?php

use Illuminate\Support\Facades\Route;

Route::get('invoices/example/random', 'InvoicesUsage\Http\Controllers\Invoices\Example\RandomController@random')->name('invoice-random');
Route::get('invoices/example/advanced', 'InvoicesUsage\Http\Controllers\Invoices\Example\AdvancedUsageController@advanced')->name('invoice-advanced');
Route::get('invoices/example/alternatives', 'InvoicesUsage\Http\Controllers\Invoices\Example\AlternativesController@alternatives')->name('invoice-alternatives');
