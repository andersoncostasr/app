<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return "Home Tenant";
});

Route::get('/tenants', function () {
    return "Home Tenants";
});
