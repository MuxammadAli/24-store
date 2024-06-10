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
        '/payment/*',
        '/dashboard/categories/position',
        'pages/upload/image',
        '/cart/store',
        '/cart/remove/all',

        '/checkout',
        '/dashboard/products/preview/store',

        '/credit/apelsin/handle/confirm',
        '/credit/apelsin/handle/confirm/status',
        '/credit/apelsin/handle/comment',
        '/dashboard/posts/upload/image'
    ];
}
