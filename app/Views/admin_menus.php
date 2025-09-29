<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メニュー管理 - 美容院予約システム</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1><a href="<?= base_url('admin/dashboard') ?>">管理画面</a> ＞ メニュー管理</h1>
        <a href="<?= base_url('logout') ?>" class="logout-btn">ログアウト</a>
        
        <div class="nav">
            <a href="<?= base_url('admin/menus/create') ?>" class="button">新規メニュー追加</a>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (empty($menus)): ?>
            <div class="text-center">
                <p>メニューが登録されていません。</p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>メニュー名</th>
                        <th>価格</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= $menu['id'] ?></td>
                        <td><?= htmlspecialchars($menu['name']) ?></td>
                        <td>¥<?= number_format($menu['price']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/menus/edit/' . $menu['id']) ?>">編集</a> | 
                            <a href="<?= base_url('admin/menus/delete/' . $menu['id']) ?>" 
                               onclick="return confirm('本当に削除しますか？')" class="danger">削除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
