<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>美容院予約システム</title>
</head>
<body>
    <h1>美容院予約フォーム</h1>
    
    <div style="text-align: right; margin-bottom: 20px;">
        <a href="<?= base_url('logout') ?>" style="background-color: #ff4444; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">ログアウト</a>
    </div>
    
    <form method="post" action="appointment/save">
        <div>
            <label>お名前:</label>
            <input type="text" name="name" required>
        </div>
        
        <div>
            <label>予約日:</label>
            <input type="date" name="appointment_date" required>
        </div>
        
        <div>
            <label>予約時間:</label>
            <input type="time" name="appointment_time" required>
        </div>
        
        <div>
            <label>電話番号:</label>
            <input type="text" name="phone">
        </div>
        
        <div>
            <button type="submit">予約する</button>
        </div>
    </form>
</body>
</html>
