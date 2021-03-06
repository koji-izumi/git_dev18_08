<?php
require_once('../funcs.php');
session_start();
if (!isset($_SESSION["admin_EMAIL"])) {
  redirect('index.php');
  exit;
}
$id = $_GET['id'];

$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_admin_user_table WHERE id =" . $id);
$status = $stmt->execute();

if ($status == false) {
  sql_error($status);
} else {
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
  <link rel="stylesheet" href="../css/style_login.css">
</head>

<body>
  <div class="form">
    <h1 class="title">管理ユーザー登録</h1>
    <form action="admin_update.php" method="post">
      <div class="form-top">
        <input type="hidden" name="id" value="<?= h($row['id']) ?>">
        <label for="name">名前</label>
        <input type="text" name="name" value="<?= h($row['name']) ?>" required>
        <label for="email">E-mail</label>
        <input type="email" name="email" value="<?= h($row['email']) ?>" required>
        <label for="password">パスワード</label>
        <input type="password" name="password" required>
        <div>
          <input type="checkbox" name="kanri_flag" value=1 <?php if ($row['kanri_flag'] == 1) {
                                                              echo "checked='checked'";
                                                            } ?>><label for="kanri_flag">スーパー管理者に設定</label>
        </div>
        <div>
          <input type="checkbox" name="life_flag" value=1 <?php if ($row['life_flag'] == 1) {
                                                            echo "checked='checked'";
                                                          } ?>><label for="life_flag">在籍中</label>
        </div>
      </div>
      <div class="form-bottom">
        <button type="submit">登録</button>
        <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
        <a href="admin.php">管理画面へ</a>
      </div>
    </form>
  </div>
</body>

</html>