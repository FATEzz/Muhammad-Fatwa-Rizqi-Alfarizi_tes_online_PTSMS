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
        // Baris ini mengecualikan SEMUA route yang diawali /api/
        // dari pemeriksaan CSRF. Ini WAJIB untuk API token-based di web.php.
        'api/*', 
    ];
}