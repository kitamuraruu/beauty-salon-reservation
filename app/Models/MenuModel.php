<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price'];
    
    /**
     * 全てのメニューを取得
     * 
     * @return array
     */
    public function getAllMenus()
    {
        return $this->findAll();
    }
    
    /**
     * メニューを保存
     * 
     * @param array $data
     * @return int|false
     */
    public function saveMenu($data)
    {
        return $this->insert($data);
    }
    
    /**
     * メニューを更新
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateMenu($id, $data)
    {
        return $this->update($id, $data);
    }
    
    /**
     * メニューを削除
     * 
     * @param int $id
     * @return bool
     */
    public function deleteMenu($id)
    {
        return $this->delete($id);
    }
    
    /**
     * メニューをIDで取得
     * 
     * @param int $id
     * @return array|null
     */
    public function getMenuById($id)
    {
        return $this->find($id);
    }
}
