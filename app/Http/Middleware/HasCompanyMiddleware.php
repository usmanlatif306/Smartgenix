<?php

namespace App\Http\Middleware;

use App\Enums\GarageUserType;
use App\Models\Garage\GarageUser;
use Closure;
use Illuminate\Http\Request;

class HasCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $vehicles = is_string(auth()->user()->setup?->vehicles) ? json_decode(auth()->user()->setup?->vehicles, true) : auth()->user()->setup?->vehicles;

        if (auth()->user()->setup && count($vehicles) < 1) {
            $garage_user = GarageUser::where('email', auth()->user()->email)->first();

            if (!auth()->user()->company && $garage_user?->type === GarageUserType::Admin) {
                return to_route('company.account')->with('error', trans('general.fill_all_fields'));
            }
        }

        return $next($request);
    }
}
