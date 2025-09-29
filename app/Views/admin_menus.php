<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メニュー管理 - 美容院予約システム</title>
</head>
<body>
    <h1><a href="<?= base_url('admin/dashboard') ?>">管理画面</a> ＞ メニュー管理</h1>
    <p>
        <a href="<?= base_url('admin/menus/create') ?>">新規メニュー追加</a> | 
    </p>
    
    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    
    <?php if (empty($menus)): ?>
        <p>メニューが登録されていません。</p>
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
                           onclick="return confirm('本当に削除しますか？')">削除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
