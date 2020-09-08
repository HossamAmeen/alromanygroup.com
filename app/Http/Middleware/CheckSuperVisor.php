<?php namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;

class CheckSuperVisor
{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!UserModel::isSuperVisor()) {
			return redirect('/admin');
		} else {
			return $next($request);
		}

	}
}//enc class check admin
