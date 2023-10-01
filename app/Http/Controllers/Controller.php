<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * Kiểm tra quyền
     *
     * @param mixed $user Truyền biến user muốn kiểm tra, ví dụ Auth::user()
     * @param string $model tên một database, nó là tên role muốn kiểm tra,
     * @param string $role quyền muốn kiểm tra, gồm c u r d
     * @param bool $force_auth có cần đăng nhập hay không, mặc định là có
     * @return array Trả về một mảng gồm status kết quả true và false, error_code và message
     */
    public function is_allow($user, $model, $role, $force_auth = true)
    {
        if ($force_auth) {
            if (!isset($user->role)) {
                return 1;
            }
        } else {
            return 0;
        }
        $role_user = Role::whereIn('_id', $user->role)->pluck('permissions')[0];
        if (!isset($role_user[$model])) {
            return 2;
        }
        $is_role = in_array($role, $role_user[$model]);
        return $is_role ? 0 : 2;
    }
    public function upload_file($filename, $path, $file, $is_unlink = false, $old_file = null)
    {
        $file->move($path, $filename);
        if ($is_unlink) {
            try {
                unlink($path . '/' . $old_file);
            } catch (\Throwable $th) {
            }
        }
    }
}
