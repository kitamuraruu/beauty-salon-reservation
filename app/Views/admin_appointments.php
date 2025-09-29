<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>予約一覧 - 美容院予約システム</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h1><a href="<?= base_url('admin/dashboard') ?>">管理画面</a> ＞ 予約一覧</h1>
        <a href="<?= base_url('logout') ?>" class="logout-btn">ログアウト</a>
        
        <?php if (!empty($appointments)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>お名前</th>
                        <th>予約日</th>
                        <th>予約時間</th>
                        <th>電話番号</th>
                        <th>メニュー</th>
                        <th>登録日時</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['id'] ?></td>
                        <td><?= htmlspecialchars($appointment['name']) ?></td>
                        <td><?= $appointment['appointment_date'] ?></td>
                        <td><?= $appointment['appointment_time'] ?></td>
                        <td><?= htmlspecialchars($appointment['phone']) ?></td>
                        <td>
                            <?php if (isset($appointment['menu_name'])): ?>
                                <?= htmlspecialchars($appointment['menu_name']) ?> - ¥<?= number_format($appointment['menu_price']) ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= $appointment['created_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center">
                <p>予約がありません</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
