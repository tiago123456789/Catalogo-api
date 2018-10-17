<?php

namespace App\Http\Middleware;

use App\Exceptions\BusinessLogicException;
use App\Exceptions\NotFoundException;
use Closure;
use Illuminate\Validation\ValidationException;

class HandlerExceptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->exception) {
            $errorDetail = $this->getErrorDetails($response->exception);
            return response()->json($errorDetail, $errorDetail->statusCode);
        }

        return $response;
    }

    private function getErrorDetails(\Exception $exception) {
        $errorDetails = new \StdClass();

        if ($exception instanceof NotFoundException) {
            $errorDetails->statusCode = 404;
            $errorDetails->message = $exception->getMessage();
        }

        if ($exception instanceof BusinessLogicException) {
            $errorDetails->statusCode = 409;
            $errorDetails->message = $exception->getMessage();
        }

        if ($exception instanceof  ValidationException) {
            $errorDetails->statusCode = 400;
            $errorDetails->message = $exception->errors();
        }

        return $errorDetails;
    }
}
