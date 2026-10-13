<?php

namespace App\Http\Middleware;

use App\Support\ContextoAuditoria;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstablecerContextoAuditoria
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        ContextoAuditoria::establecer($request, $request->user()?->getAuthIdentifier());

        return $next($request);
    }
}
