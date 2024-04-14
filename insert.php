<?php
//1. POSTデータ取得
//[name,email,age,naiyou]
$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$naiyou = $_POST["naiyou"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=lumina-mind_gs_kadai;charset=utf8;host=mysql652.db.sakura.ne.jp','lumina-mind','IAMsplover7128'); //接続の設定、rootはXAMPPの場合、さくらデータベースの場合はID名、アドレスの箇所に変更
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//３．データ登録SQL作成 //SQLにセットする
$sql = "INSERT INTO gs_an_table(name,email,age,naiyou,indate)VALUES(:name, :email, :age, :naiyou, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) //バインド変数でクリーニングする機能
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //true or false （無事にデータが入ったらtrue、失敗したらfalse）

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]); //エラーメッセージに自分がわかる言葉を入れてあげる
}else{
  //５．index.phpへリダイレクト
header("Location: index.php");
exit();

}
?>
