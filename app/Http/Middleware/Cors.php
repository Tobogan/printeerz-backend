<?php
// app/Http/Middleware/Cors.php
// It's possible to generate the file with artisan (see comment)
namespace App\Http\Middleware;
use Closure;
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return [
                /*
                |--------------------------------------------------------------------------
                | Laravel CORS
                |--------------------------------------------------------------------------
                |
                | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
                | to accept any value.
                |
                */
                'supportsCredentials' => false,
                'allowedOrigins' => ['*'],
                'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
                'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
                'exposedHeaders' => [],
                'maxAge' => 0,
            ];
    }
}
