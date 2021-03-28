<?php

namespace App\Http\Middleware;

use Auth0\Login\Contract\Auth0UserRepository;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Closure;

class JWTVerifierScope
{
    protected $userRepository;

    /**
     * CheckScope constructor.
     *
     * @param Auth0UserRepository $userRepository
     */
    public function __construct(Auth0UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \string  $scope
     * @return mixed
     */
    public function handle($request, Closure $next, $scope)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken();
        try {
            $tokenInfo = $auth0->decodeJWT($accessToken);
            $user = $this->userRepository->getUserByDecodedJWT($tokenInfo);
            if (!$user) {
                return response()->json(['success' => false, "message" => "Unauthorized user", 'type'=>'Unauthorized'], 401);
            }



            if ($scope) {
                $hasScope = false;
                if (isset($tokenInfo['scope'])) {
                    $scopesAPI = explode(" ", $tokenInfo['scope']);
                    foreach ($scopesAPI as $s) {
                        if (trim($s) === $scope) {
                            $hasScope = true;
                        }
                    }

                    // return response()->json([
                    //     'success' => false,
                    //     "message" => $tokenInfo,
                    //     'scope'=>$scope,
                    //     'scopesAPI'=>$scopesAPI,
                    //     'hasScope'=>$hasScope,
                    //     'type'=>'token'
                    // ], 201);
                }
                if (!$hasScope) {
                    return response()->json(['success' => false, "message" => "Insufficient scope", 'type'=>'Insufficient'], 403);
                }

                \Auth::login($user);
            }
        } catch (InvalidTokenException $e) {
            return response()->json(['success' => false, "message" => $e->getMessage(), 'type'=>'InvalidToken'], 401);
        } catch (CoreException $e) {
            return response()->json(['success' => false, "message" => $e->getMessage(), 'type'=>'Core'], 401);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage(), 'type'=>'Exception Generic'], 500);
        }

        return $next($request);
    }
}
