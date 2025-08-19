<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Feature;

class InjectFeature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if route starts with 'blog-management', inject the 'blog' feature
        if ($request->is('blog-management*')) {
            $feature = Feature::where('name', 'blog')->firstOrFail();
            // inject into route parameters instead of attributes
            $request->route()->setParameter('feature', $feature);
        }

        return $next($request);
    }
}
