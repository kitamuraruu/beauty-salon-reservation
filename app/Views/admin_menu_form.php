<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メニュー追加 - 美容院予約システム</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1><a href="<?= base_url('admin/dashboard') ?>">管理画面</a> ＞ <a href="<?= base_url('admin/menus') ?>">メニュー管理</a> ＞ メニュー追加</h1>
        <a href="<?= base_url('logout') ?>" class="logout-btn">ログアウト</a>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?= base_url('admin/menus/save') ?>">
            <div class="form-group">
                <label for="name">メニュー名:</label>
                <input type="text" name="name" id="name" required maxlength="100" 
                       value="<?= old('name') ?>" placeholder="例: カット">
            </div>
            
            <div class="form-group">
                <label for="price">価格:</label>
                <input type="number" name="price" id="price" required min="0" 
                       value="<?= old('price') ?>" placeholder="例: 3000">
            </div>
            
            <div class="form-group">
                <button type="submit">メニューを追加</button>
            </div>
        </form>
    </div>
</body>
</html>
