<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=lumina-mind_gs_kadai;charset=utf8;host=mysql652.db.sakura.ne.jp','lumina-mind','IAMsplover7128');
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); // true or false

//３．データ表示
// $view=""; //以前のデータ無視
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]); //エラーメッセージが何かわかる文字列
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード] fetch = 繰り返して取ってくる
//JSONい値を渡す場合に使う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
div{padding: 10px;font-size:16px;}
td{border: 1px dashed black;}
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] phpの中にHTMLを書ける仕組み --> 
<div>
    <div class="container jumbotron"> 
<?php foreach($values as $value) { ?>
  <table>
    <tr>
  <td><?=$value["id"]?></td>
  <td><?=$value["name"]?></td>
  <td><?=$value["email"]?></td>
  <td><?=$value["indate"]?></td>
  </table>
<?php } ?>

    </div>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り


</script>
</body>
</html>
