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
        
        // 管理者権限を確認
        if (!$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        // 管理者ダッシュボード（メインページ）
        return view('admin_dashboard');
    }
    
    /**
     * 予約一覧表示
     */
    public function appointments()
    {
        // ログイン状態を確認
        if (!$this->checkLogin()) {
            return redirect()->to('/login');
        }
        
        // 管理者権限を確認
        if (!$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        // 予約一覧を取得（メニュー情報も含める）
        $appointmentModel = new \App\Models\AppointmentModel();
        $menuModel = new \App\Models\MenuModel();
        
        $appointments = $appointmentModel->findAll();
        
        // 各予約にメニュー情報を追加
        foreach ($appointments as &$appointment) {
            if ($appointment['menu_id']) {
                $menu = $menuModel->getMenuById($appointment['menu_id']);
                if ($menu) {
                    $appointment['menu_name'] = $menu['name'];
                    $appointment['menu_price'] = $menu['price'];
                }
            }
        }
        
        $data = [
            'appointments' => $appointments
        ];
        
        return view('admin_appointments', $data);
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
    
    /**
     * メニュー一覧表示
     */
    public function menus()
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        $menuModel = new \App\Models\MenuModel();
        $menus = $menuModel->getAllMenus();
        
        $data = [
            'menus' => $menus ?: []
        ];
        
        return view('admin_menus', $data);
    }
    
    /**
     * メニュー追加フォーム表示
     */
    public function createMenu()
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        return view('admin_menu_form');
    }
    
    /**
     * メニュー保存処理
     */
    public function saveMenu()
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        // フォームデータを取得
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price')
        ];
        
        // バリデーション
        if (empty($data['name']) || empty($data['price'])) {
            return redirect()->back()->with('error', 'メニュー名と価格を入力してください');
        }
        
        if (!is_numeric($data['price']) || $data['price'] < 0) {
            return redirect()->back()->with('error', '価格は0以上の数値を入力してください');
        }
        
        try {
            $menuModel = new \App\Models\MenuModel();
            $result = $menuModel->saveMenu($data);
            
            if ($result) {
                return redirect()->to('/admin/menus')->with('success', 'メニューを追加しました');
            } else {
                return redirect()->back()->with('error', 'メニューの保存に失敗しました');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'エラーが発生しました: ' . $e->getMessage());
        }
    }
    
    /**
     * メニュー編集フォーム表示
     */
    public function editMenu($id)
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        $menuModel = new \App\Models\MenuModel();
        $menu = $menuModel->getMenuById($id);
        
        if (!$menu) {
            return redirect()->to('/admin/menus')->with('error', 'メニューが見つかりません');
        }
        
        $data = [
            'menu' => $menu
        ];
        
        return view('admin_menu_edit', $data);
    }
    
    /**
     * メニュー更新処理
     */
    public function updateMenu($id)
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        // フォームデータを取得
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price')
        ];
        
        // バリデーション
        if (empty($data['name']) || empty($data['price'])) {
            return redirect()->back()->with('error', 'メニュー名と価格を入力してください');
        }
        
        if (!is_numeric($data['price']) || $data['price'] < 0) {
            return redirect()->back()->with('error', '価格は0以上の数値を入力してください');
        }
        
        try {
            $menuModel = new \App\Models\MenuModel();
            $result = $menuModel->updateMenu($id, $data);
            
            if ($result) {
                return redirect()->to('/admin/menus')->with('success', 'メニューを更新しました');
            } else {
                return redirect()->back()->with('error', 'メニューの更新に失敗しました');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'エラーが発生しました: ' . $e->getMessage());
        }
    }
    
    /**
     * メニュー削除処理
     */
    public function deleteMenu($id)
    {
        // ログイン状態と管理者権限を確認
        if (!$this->checkLogin() || !$this->checkAdmin()) {
            return redirect()->to('/login');
        }
        
        try {
            $menuModel = new \App\Models\MenuModel();
            $result = $menuModel->deleteMenu($id);
            
            if ($result) {
                return redirect()->to('/admin/menus')->with('success', 'メニューを削除しました');
            } else {
                return redirect()->to('/admin/menus')->with('error', 'メニューの削除に失敗しました');
            }
        } catch (Exception $e) {
            return redirect()->to('/admin/menus')->with('error', 'エラーが発生しました: ' . $e->getMessage());
        }
    }
    
}
