<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class ConfiguracionController extends Controller
{
    public function clear()
    {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared  and  Clear cache</h1>';
    }
}
