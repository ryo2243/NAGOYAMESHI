<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsSubscribed {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if ($request->user() && !$request->user()->subscribed('premium_plan')) {
            // This user is not a paying customer...
            return redirect()->route('subscription.create')->with('subscription_message', 'この機能を利用するには有料プランへの登録が必要です。');
        }

        return $next($request);
    }
}
