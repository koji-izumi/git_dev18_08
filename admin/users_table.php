<?php
require_once('../funcs.php');
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT id,name,email,register_datetime FROM gs_users_table");
$status = $stmt->execute();

$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<th>' . h($result['id']) . '</th><th>' . h($result['name']) . '</th><th>' . h($result['email']) . '</th><th>' . h($result['register_datetime']) . '</th>';
        $view .= '</tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_myPage.css">
    <title>admin</title>
</head>

<body>
    <div class="header">
        <a href="signUp.php">ユーザー登録</a>
        <a href="admin.php">管理画面へ</a>
    </div>
    <div class="table">
        <table>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>E-mail</th>
                <th>登録日時</th>
            </tr>
            <?= $view ?>
        </table>
    </div>
</body>

</html>