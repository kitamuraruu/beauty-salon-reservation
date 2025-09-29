<?php

namespace App\Controllers;

class AppointmentController extends BaseController
{
    public function index()
    {
        // ログイン状態を確認
        if (!$this->checkLogin()) {
            return redirect()->to('/login');
        }
        
        // メニューデータを取得
        $menuModel = new \App\Models\MenuModel();
        $menus = $menuModel->getAllMenus();
        
        $data = [
            'menus' => $menus ?: []
        ];
        
        return view('appointment_form', $data);
    }
    
    public function save()
    {
        // ログイン状態を確認
        if (!$this->checkLogin()) {
            return redirect()->to('/login');
        }
        
        // フォームデータを取得
        $data = [
            'name' => $this->request->getPost('name'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'appointment_time' => $this->request->getPost('appointment_time'),
            'phone' => $this->request->getPost('phone'),
            'menu_id' => $this->request->getPost('menu_id')
        ];
        
        try {
            // モデルを使ってデータベースに保存
            $model = new \App\Models\AppointmentModel();
            $result = $model->saveAppointment($data);
            
            // 結果を表示
            if ($result) {
                // 選択されたメニュー情報を取得
                $menuModel = new \App\Models\MenuModel();
                $selectedMenu = $menuModel->getMenuById($data['menu_id']);
                
                echo "予約が完了しました！<br>";
                echo "お名前: " . $data['name'] . "<br>";
                echo "予約日: " . $data['appointment_date'] . "<br>";
                echo "予約時間: " . $data['appointment_time'] . "<br>";
                echo "電話番号: " . $data['phone'] . "<br>";
                if ($selectedMenu) {
                    echo "メニュー: " . $selectedMenu['name'] . " - ¥" . number_format($selectedMenu['price']) . "<br>";
                }
                echo "<br><a href='" . base_url('appointment') . "'>新しい予約をする</a>";
            } else {
                echo "予約の保存に失敗しました。";
            }
        } catch (Exception $e) {
            echo "エラーが発生しました: " . $e->getMessage();
        }
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
}
