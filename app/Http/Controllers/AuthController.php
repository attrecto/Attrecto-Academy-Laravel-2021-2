<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Login",
     *     tags={"Auth"},
     *     @OA\Parameter(name="processTypeId",description="process type id", in = "path",required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(response=401, description="Authentication required!"),
     *     @OA\Response(response=403, description="Forbidden request!"),
     *     @OA\Response(response=422, description="Something went wrong!"),
     *     @OA\Response(response=500, description="Internal server error!")
     * )
     * @param RegisterAdminRequest $request
     * @return JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/api/users/me",
     *     operationId="me",
     *     security={ {"jwtAuth" : {}}},
     *     tags={"Users"},
     *     description="Get me",
     *     summary="Get me",
     *     @OA\Response(
     *      response=200,
     *      description="Succes return",
     *      @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Response(response=404, description="Not found"),
     * )
     * /**
     * Display a listing of the resource.
     */
    public function me()
    {
        return response()->json(UserResource::make(auth()->user()));
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token
        ]);
    }
}
