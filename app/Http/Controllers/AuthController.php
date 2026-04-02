<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        // Now we know this part works perfectly!
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        // --- GENERATE TOKEN ---
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(env('JWT_SECRET'))
        );

        $now = new \DateTimeImmutable();

        $token = $config->builder()
            ->issuedBy(env('APP_URL'))
            ->issuedAt($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', $user->id)
            ->getToken($config->signer(), $config->signingKey());

        return response()->json([
            'access_token' => $token->toString(),
            'token_type' => 'bearer'
        ]);
    }
}