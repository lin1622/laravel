<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 从 CSRF 验证中排除的 URL
     *
     * @var array
     */
    protected $except = [
        //
        'alipay/*',
    ];
}
