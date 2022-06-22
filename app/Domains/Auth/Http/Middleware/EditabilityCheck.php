<?php

namespace App\Domains\Auth\Http\Middleware;

use App\Domains\Auth\Models\User;
use Closure;

/**
 * Class AdminCheck.
 */
class EditabilityCheck
{
    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($request->user() && ($user->isType(User::TYPE_ADMIN) || $user->isType(User::TYPE_MAINTAINER) || $user->isType(User::TYPE_TECH_OFFICER))) {
            return $next($request);
        }

        return redirect()->route('admin.dashboard')->withFlashDanger(__('You do not have access to do that.'));
    }
}
