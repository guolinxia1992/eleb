<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/api/regist','/api/checkLogin','/api/addAddress','/api/cart','/api/editAddress','/api/addCart','/api/cart','/api/addOrder','/api/changePassword','/api/forgetPassword'
    ];
}
