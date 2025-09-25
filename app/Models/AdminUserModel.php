<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'password', 'user_type', 'created_at', 'updated_at'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * ユーザー認証（練習用：平文パスワード比較）
     * 
     * @param string $user_id ユーザーID
     * @param string $password パスワード
     * @return array|false 認証成功時はユーザー情報、失敗時はfalse
     */
    public function authenticate($user_id, $password)
    {
        $user = $this->where('user_id', $user_id)->first();
        
        if ($user && $password === $user['password']) {
            return $user;
        }
        
        return false;
    }
    
    /**
     * ユーザーIDでユーザー情報を取得
     * 
     * @param string $user_id ユーザーID
     * @return array|null ユーザー情報
     */
    public function getUserByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }
    
    /**
     * パスワードをハッシュ化
     * 
     * @param string $password 平文パスワード
     * @return string ハッシュ化されたパスワード
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
