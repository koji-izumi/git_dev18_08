<?php
require_once('../funcs.php');
$name = $_POST['name'];
$id = $_POST['id'];

if (isset($_POST['kanri_flag'])) {
  $kanri_flag = 1;
} else {
  $kanri_flag = 0;
}
if (isset($_POST['life_flag'])) {
  $life_flag = 1;
} else {
  $life_flag = 0;
}

$pdo = db_conn();

if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '<script type="text/javascript">alert("入力された値が正しくありません。");</script>';
  return false;
}

//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
  echo '<script type="text/javascript">alert("パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。");</script>';
  return false;
}

$stmt = $pdo->prepare("UPDATE gs_admin_user_table 
                        SET name=:name,
                            email=:email,
                            password=:password,
                            kanri_flag=:kanri_flag,
                            life_flag=:life_flag,
                            indate=sysdate()
                        WHERE id=:id;");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flag', $kanri_flag, PDO::PARAM_INT);
$stmt->bindValue(':life_flag', $life_flag, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();



//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
} else {
  redirect('admin.php');
}
