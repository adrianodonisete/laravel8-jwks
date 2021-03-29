<?php

namespace App\Http\Middleware;

use Auth0\Login\Contract\Auth0UserRepository;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Closure;

class JWTVerifier
{
    protected $userRepository;
    
    public function __construct(Auth0UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle($request, Closure $next)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken();
        try {
            $tokenInfo = $auth0->decodeJWT($accessToken);
            $user = $this->userRepository->getUserByDecodedJWT($tokenInfo);
            if (!$user) {
                return response()->json([
                    'success' => false, "message" => "Unauthorized user", 'type'=>'Unauthorized'], 401);
            }

            \Auth::login($user);

            return response()->json(
                [
                    'success' => true,
                    "message" => "Hello from a private endpoint! You need to have a valid access token to see this.",
                    'user' => $user
                ],
                200
            );
        } catch (InvalidTokenException $e) {
            return response()->json(['success' => false, "message" => $e->getMessage(), 'type'=>'InvalidToken'], 401);
        } catch (CoreException $e) {
            return response()->json(["message" => $e->getMessage(), 'type'=>'Core'], 401);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage(), 'type'=>'Exception Generic'], 500);
        }

        return $next($request);
    }
}
