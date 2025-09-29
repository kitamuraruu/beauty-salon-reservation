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
            <label for="name">お名前:</label>
            <input type="text" name="name" id="name" required maxlength="10" 
                   title="お名前を10文字以内で入力してください">
        </div>
        
        <div>
            <label>予約日:</label>
            <input type="date" name="appointment_date" required>
        </div>
        
        <div>
            <label>予約時間:</label>
            <select name="appointment_time" required>
                <option value="">時間を選択してください</option>
                <option value="09:00">9:00</option>
                <option value="09:30">9:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
            </select>
        </div>
        
        <div>
            <label for="phone">電話番号（携帯電話のみ）:</label>
            <input type="tel" name="phone" id="phone" 
                   pattern="^0[789]0[0-9]{8}$" 
                   maxlength="11"
                   placeholder="09012345678"
                   title="携帯電話番号を11桁で入力してください（例：09012345678）">
            <div id="phone-error" class="error-message" style="color: red; font-size: 12px; margin-top: 5px;"></div>
        </div>
        
        <div>
            <label for="menu_id">メニュー:</label>
            <select name="menu_id" id="menu_id" required>
                <option value="">メニューを選択してください</option>
                <?php if (isset($menus) && !empty($menus)): ?>
                    <?php foreach ($menus as $menu): ?>
                        <option value="<?= $menu['id'] ?>"><?= htmlspecialchars($menu['name']) ?> - ¥<?= number_format($menu['price']) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div>
            <button type="submit">予約する</button>
        </div>
    </form>
</body>
</html>
