<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        // 管理者ログインフォームを表示
        return view('login');
    }
    
    public function login()
    {
        // ログイン処理（データベース認証）
        $user_id = $this->request->getPost('user_id');
        $password = $this->request->getPost('password');
        
        // バリデーション
        if (empty($user_id) || empty($password)) {
            return redirect()->back()->with('error', 'ユーザーIDとパスワードを入力してください');
        }
        
        // データベースで認証
        $adminUserModel = new \App\Models\AdminUserModel();
        
        $user = $adminUserModel->authenticate($user_id, $password);
        
        if ($user) {
            // セッションにユーザー情報を保存
            $session = session();
            $session->set([
                'user_id' => $user['user_id'],
                'user_type' => $user['user_type'],
                'is_logged_in' => true
            ]);
            
            // ユーザータイプに応じてリダイレクト
            if ($user['user_type'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/appointment');
            }
        } else {
            return redirect()->back()->with('error', 'ユーザーIDまたはパスワードが正しくありません');
        }
    }
    
    public function dashboard()
    {
        // ログイン状態を確認
        if (!$this->checkLogin()) {
            return redirect()->to('/login');
        }
        
        // 管理者ダッシュボード（予約一覧）
        $model = new \App\Models\AppointmentModel();
        $appointments = $model->findAll();
        
        $data = [
            'appointments' => $appointments
        ];
        
        return view('admin_dashboard', $data);
    }
    
    /**
     * ログアウト処理
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('message', 'ログアウトしました');
    }
    
    /**
     * ログイン状態を確認
     * 
     * @return bool ログインしている場合はtrue、していない場合はfalse
     */
    private function checkLogin()
    {
        $session = session();
        return $session->get('is_logged_in') === true;
    }
    
    /**
     * 管理者権限を確認
     * 
     * @return bool 管理者の場合はtrue、そうでない場合はfalse
     */
    private function checkAdmin()
    {
        $session = session();
        return $session->get('user_type') === 'admin';
    }
    
}
