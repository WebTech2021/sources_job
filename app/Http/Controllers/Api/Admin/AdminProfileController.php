<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminDetailsResource;
use App\Repository\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @property AdminRepositoryInterface $admin
 */
class AdminProfileController extends Controller
{
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->admin = $adminRepository;
    }

    public function myInfo()
    {
        return response()->json(['success' => true, 'data' => new AdminDetailsResource(auth('admin')->user())]);
    }

    public function updateInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'min:5', 'max:255'],
            'avatar' => ['image', 'mimes:jpeg,jpg,png'],
            'email' => ['email'],
            'old_password' => ['required_if:password,', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Wrong Old Password');
                }
            },],
            'password' => 'string|min:8|max:20|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $this->admin->updateAdminData($validated);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json(['success'=>false, 'message'=>$error->getMessage()]);
        }
        return response()->json(['success'=>true, 'message'=>'Profile Updated!']);
    }
}
