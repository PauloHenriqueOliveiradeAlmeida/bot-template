<?php

namespace App\Shared\Entrypoint\Http\Middlewares;

use App\Shared\App\States\Tenant;
use App\Shared\Infra\Database\Models\Company;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{

    public function __construct(
        private readonly Company $company
    ) {
    }

    /**
     * @param Closure(Request): \Illuminate\Support\Facades\Response $next
     */
    public function handle(Request $request, Closure $next)
    {
        $tenantId = $request->input("WaId");
        $company = $this->company->where('external_id', '=', $tenantId)->first(['tenant_id']);

        Tenant::define($company->tenant_id, [$tenantId]);

        return $next($request);
    }
}