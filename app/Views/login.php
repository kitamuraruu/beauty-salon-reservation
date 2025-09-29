<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color: red; background-color: #ffe6e6; padding: 10px; border: 1px solid #ff9999; margin-bottom: 10px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('message')): ?>
        <div style="color: green; background-color: #e6ffe6; padding: 10px; border: 1px solid #99ff99; margin-bottom: 10px;">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    
    <form method="post" action="<?= base_url('login') ?>">
        <div>
            <label>ユーザーID:</label>
            <input type="text" name="user_id" required>
        </div>
        
        <div>
            <label>パスワード:</label>
            <input type="password" name="password" required>
        </div>
        
        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
    
    <hr>
    <p>テスト用: ID=admin（管理者）, ID=user（一般ユーザー）, パスワード=ID+123</p>
</body>
</html>
