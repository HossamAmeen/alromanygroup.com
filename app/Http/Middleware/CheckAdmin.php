<?php namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;

class CheckAdmin
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
		if (!UserModel::isManger()) {
			return redirect('/admin');
		} else {
			return $next($request);
		}

	}
}//enc class check admin
