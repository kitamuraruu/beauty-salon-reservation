<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1>ログイン</h1>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?= base_url('login') ?>">
            <div class="form-group">
                <label>ユーザーID:</label>
                <input type="text" name="user_id" required>
            </div>
            
            <div class="form-group">
                <label>パスワード:</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <button type="submit">ログイン</button>
            </div>
        </form>
        
        <div class="alert info">
            <strong>テスト用:</strong> ID=admin（管理者）, ID=user（一般ユーザー）, パスワード=ID+123
        </div>
    </div>
</body>
</html>
