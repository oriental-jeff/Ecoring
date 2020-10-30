<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    const MODULE = 'reports';

    public function index() {
        return redirect(route('backend.reports.orders'));
    }

    // Continue
    public function orders() {
        $this->authorize(mapPermission(self::MODULE));


    }
}
