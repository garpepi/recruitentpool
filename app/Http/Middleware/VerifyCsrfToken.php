<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'http://localhost/cognito-hooks',
        'https://localhost/cognito-hooks',
        'http://dffc-118-136-75-240.ngrok.io/cognito-hooks',
        'https://dffc-118-136-75-240.ngrok.io/cognito-hooks'
    ];
}
