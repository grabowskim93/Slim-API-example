<?php
/**
 * Created by PhpStorm.
 * User: mateuszgra
 * Date: 2016-10-18
 * Time: 12:36
 */

namespace App\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Resource\TokenResource;

class AuthToken
{
    private $tokenResource;

    public function __construct(TokenResource $tokenResource)
    {
        $this->tokenResource = $tokenResource;
    }

    public function auth(ServerRequestInterface $request, ResponseInterface $response, $next) {
        $token = $request->getHeader('Authorization');
        if ($this->tokenResource->check($token)){
            $response = $next($request, $response);
            return $response;
        } else {
            return $response->withStatus(401);
        }
    }
}