<?php

namespace App\Http\Middleware;

use App\Http\Traits\PaginateTrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

class AllGuards extends  BaseMiddleware
{

    use PaginateTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $guard = null)
    {
//        $token = request()->header('Authorization');
//        dd($token);
//        return apiResponse('',$token,'400');
        if ($guard != null){
//            auth()->shouldUse($guard);
            $token = request()->header('Authorization');
            $request->headers->set('auth_token' , (string) $token ,true);
            $request->headers->set('Authorization' , 'Bearer ' .  $token ,true);
            try {
                $user = JWTAuth::parseToken()->authenticate();//check authenticated user or not
            }
            catch (TokenExpiredException $e){
                return $this->apiResponse(null,'Un authenticated user','simple','422');
            }
            catch (JWTException $e){
                return $this->apiResponse(null,$e->getMessage(),'simple','422');
            }
        }
        return $next($request);
    }


}
