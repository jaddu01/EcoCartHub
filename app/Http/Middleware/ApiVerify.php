<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $user = $request->user('api');
            if (!$user) {
                return ResponseBuilder::error('Unauthorized', 401);
            }
            return $next($request);
        }catch(\Exception $e){
            return ResponseBuilder::error("Oops! Something went wrong.", 500);
        }
    }
}
