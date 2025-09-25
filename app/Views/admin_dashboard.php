<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理者ダッシュボード</title>
</head>
<body>
    <h1>管理者ダッシュボード</h1>
    
    <div style="text-align: right; margin-bottom: 20px;">
        <a href="<?= base_url('logout') ?>" style="background-color: #ff4444; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">ログアウト</a>
    </div>
    
    <h2>予約一覧</h2>
    
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color: #f0f0f0;">
            <th>ID</th>
            <th>お名前</th>
            <th>予約日</th>
            <th>予約時間</th>
            <th>電話番号</th>
            <th>登録日時</th>
        </tr>
        <?php if (!empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= $appointment['id'] ?></td>
                <td><?= $appointment['name'] ?></td>
                <td><?= $appointment['appointment_date'] ?></td>
                <td><?= $appointment['appointment_time'] ?></td>
                <td><?= $appointment['phone'] ?></td>
                <td><?= $appointment['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">予約がありません</td>
            </tr>
        <?php endif; ?>
    </table>
    
    <br>
    <p>
        <a href="../appointment">顧客向け予約フォーム</a>
    </p>
</body>
</html>
