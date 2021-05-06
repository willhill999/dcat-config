<?php

use Willhill\DcatConfig\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('dcat-config', Controllers\DcatConfigController::class);
