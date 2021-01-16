<?php
require_once('../funcs.php');
session_start();
if (!isset($_SESSION["admin_EMAIL"])) {
    redirect('index.php');
    exit;
}
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT id,name,email,kanri_flag,life_flag FROM gs_admin_user_table");
$status = $stmt->execute();

$view = "";
$check_kanri = "";
$check_life = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($result['kanri_flag'] == 1) {
            $check_kanri = '✔';
        } else {
            $check_kanri = "";
        }
        if ($result['life_flag'] == 1) {
            $check_life = '✔️';
        } else {
            $check_life = "";
        }
        $view .= '<tr>';
        $view .= '<th>' . h($result['id']) . '</th><th>' . h($result['name']) . '</th><th>' . h($result['email']) . '</th><th>' . $check_kanri . '</th><th>' . $check_life . '</th>';
        $view .= '<th><a href="admin_edit.php?id=' . h($result['id']) . '">編集</a></th>';
        $view .= '<th><a href="admin_delete.php?id=' . h($result['id']) . '">削除</a></th>';
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
        <a href="admin_signup.php">管理ユーザー登録</a>
        <a href="users_table.php">ユーザー一覧</a>
        <a href="logout.php">ログアウト</a>
    </div>
    <div class="table">
        <table>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>E-mail</th>
                <th>スーパー管理者</th>
                <th>在籍中</th>
            </tr>
            <?= $view ?>
        </table>
    </div>
</body>

</html>