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
        'mentor/upload-id-card',
        'mentor/face-verify',
        'mentor/profile',
        'mentor/save-id-card-data',
        'profile',
        'course/*/learn/bookmark/*',
    ];
}
