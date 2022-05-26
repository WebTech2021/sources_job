<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginAdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use App\Repository\AdminRepositoryInterface;
use App\Repository\Eloquent\AdminRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

/**
 * @property AdminRepository $user
 */
class AuthController extends Controller
{
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->user = $adminRepository;
    }

    /**
     * @param LoginAdminRequest $request
     * @return JsonResponse
     */
    public function login(LoginAdminRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = $this->user->findByEmail($validated['email']);

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                $object = new stdClass;
                $object->password = 'Wrong Password';
                return $this->errorResponse('Wrong Password', $object);
            }

            $accessToken = $user->createToken('authToken')->plainTextToken;

        } catch (\Exception $error) {
            return $this->errorResponse('Something went wrong!', $error, null, 500);
        }
        $responseData = [
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'adminData' => new AdminResource($user),
        ];
        return $this->successResponse('Successfully Logged in', $responseData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse('Logout Successfully');
    }

    /**
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllAdmins()
    {
        return Admin::all();
    }


}
