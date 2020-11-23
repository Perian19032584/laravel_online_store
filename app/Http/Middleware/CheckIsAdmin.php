<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{

    public function handle($request, Closure $next)
    {//Метод не мой, а то что в значение мои
        $user = Auth::user();

        if($user->is_admin == 0){
            session()->flash('warning', 'У вас нет прав администратора');
            return redirect()->route('home2');
        }
        return $next($request);
    }
}
