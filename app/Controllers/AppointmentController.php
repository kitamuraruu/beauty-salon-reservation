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
            
            if ($result) {
                // 成功メッセージをセッションに保存
                session()->setFlashdata('success', '予約が登録されました');
            } else {
                // エラーメッセージをセッションに保存
                session()->setFlashdata('error', '予約の保存に失敗しました');
            }
        } catch (Exception $e) {
            // エラーメッセージをセッションに保存
            session()->setFlashdata('error', 'エラーが発生しました: ' . $e->getMessage());
        }
        
        // 予約フォームページにリダイレクト
        return redirect()->to('/appointment');
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
