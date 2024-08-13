<?php

use Yuga\Route\Route;
use Yuga\Admin\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index']);