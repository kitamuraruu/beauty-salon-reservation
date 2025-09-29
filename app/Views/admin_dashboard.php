<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理者ダッシュボード</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1>管理画面</h1>
        <a href="<?= base_url('logout') ?>" class="logout-btn">ログアウト</a>
        <div class="nav">
            <a href="<?= base_url('admin/appointments') ?>">予約一覧</a>
            <a href="<?= base_url('admin/menus') ?>">メニュー管理</a>
        </div>
    </div>
</body>
</html>
