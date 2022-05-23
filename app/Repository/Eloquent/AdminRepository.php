<?php

namespace App\Repository\Eloquent;

use App\Models\Admin\Admin;
use App\Repository\AdminRepositoryInterface;
use App\Utilities\ImageFun;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    public function updateAdminData($data)
    {
        if (array_key_exists('avatar',$data)) {
            $data['image'] = ImageFun::uploadSingleImage($data['avatar'],'images/admin/avatar');
        }
        if (array_key_exists('password',$data)) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->model->findOrFail(auth('admin')->user()->id)->update($data);
    }

}
