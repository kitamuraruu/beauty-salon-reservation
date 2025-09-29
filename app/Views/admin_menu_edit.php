<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メニュー編集 - 美容院予約システム</title>
</head>
<body>
    <h1><a href="<?= base_url('admin/dashboard') ?>">管理画面</a> ＞ <a href="<?= base_url('admin/menus') ?>">メニュー管理</a> ＞ メニュー編集</h1>

    
    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    
    <form method="post" action="<?= base_url('admin/menus/update/' . $menu['id']) ?>">
        <p>
            <label for="name">メニュー名:</label><br>
            <input type="text" name="name" id="name" required maxlength="100" 
                   value="<?= old('name', $menu['name']) ?>" placeholder="例: カット">
        </p>
        
        <p>
            <label for="price">価格:</label><br>
            <input type="number" name="price" id="price" required min="0" 
                   value="<?= old('price', $menu['price']) ?>" placeholder="例: 3000">
        </p>
        
        <p>
            <button type="submit">メニューを更新</button>
        </p>
    </form>
</body>
</html>
