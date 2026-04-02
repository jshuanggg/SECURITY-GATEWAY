<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Illuminate\Http\Response;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $tokenString = $request->bearerToken();

        if (!$tokenString) {
            return response()->json(['error' => 'Token not provided.'], 401);
        }

        try {
            $config = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(env('JWT_SECRET')));
            $token = $config->parser()->parse($tokenString);

            // Validate expiration and signature
            if ($token->isExpired(new \DateTimeImmutable())) {
                return response()->json(['error' => 'Token expired.'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        return $next($request);
    }
}