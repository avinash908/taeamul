<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
class Handler extends ExceptionHandler
{
   
    protected $dontReport = [
      
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

  
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = Arr::get($exception->guards(), 0);

       switch ($guard) {
         case 'admin':
           $login='admin.login';
           break;

         default:
           $login='login';
           break;
       }

        return redirect()->guest(route($login));
    }
}