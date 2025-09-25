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
        
        return view('appointment_form');
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
            'phone' => $this->request->getPost('phone')
        ];
        
        try {
            // モデルを使ってデータベースに保存
            $model = new \App\Models\AppointmentModel();
            $result = $model->saveAppointment($data);
            
            // 結果を表示
            if ($result) {
                echo "予約が完了しました！<br>";
                echo "お名前: " . $data['name'] . "<br>";
                echo "予約日: " . $data['appointment_date'] . "<br>";
                echo "予約時間: " . $data['appointment_time'] . "<br>";
                echo "電話番号: " . $data['phone'] . "<br>";
                echo "<br><a href='appointment'>新しい予約をする</a>";
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
