<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-2テーブルの作成</title>
</head>

<body>
    
    <?php
    echo "処理開始<br>";
    //記入例；以下は挟まれるPHP領域に記載すること。
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！

    
    $dsn = 'mysql:dbname=tb23****db;host=localhost';
    $user = 'tb-23****';
    $password = '**********';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //記入例；以下は挟まれるPHP領域に記載すること。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    
    //id ・自動で登録されているナンバリング。
    //name ・名前を入れる。文字列、半角英数で32文字。
    //comment ・コメントを入れる。文字列、長めの文章も入る。
    
    //テーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS tbtest456"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    //＄pdoに＄sql・・・で定義した操作をする
    $stmt = $pdo->query($sql);

    
    
    echo "処理終了";
    ?>

</body>
<!--SQL文中の「 IF NOT EXISTS 」は「もしまだこのテーブルが存在しないなら」
という意味を持ちます。
これを入れないと、２回目以降にこのプログラムを呼び出した際に：
　 SQLSTATE[42S01]: Base table or view already exists: 1050 Table
　 'tbtest' already exists
という警告が発生します。
これは、既に'tbtest'というテーブルが存在しているのに、
同じな名前のテーブルを作成しようとした際に発生するエラーです。-->

</html>