<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理者ダッシュボード</title>
</head>
<body>
    <h1>管理画面</h1>
    <h2>管理メニュー</h2>
    <p>
        <a href="<?= base_url('admin/appointments') ?>" style="margin-right: 10px;">予約一覧</a>
        <a href="<?= base_url('admin/menus') ?>">メニュー管理</a>
    </p>
    <a href="<?= base_url('logout') ?>">ログアウト</a>
</body>
</html>
