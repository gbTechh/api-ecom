<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\Rol;

class Admin
{
    protected $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->modelRol = new Rol();
    }

    public function handle($request, Closure $next)
    {
        $id_rol = $request->id_rol;
        $rol = $this->modelRol->find($id_rol);
        // $nameRol = trim(strtolower($rol->name));

        if ($id_rol == 1) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
