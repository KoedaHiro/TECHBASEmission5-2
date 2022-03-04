<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-4テーブルの構成を確認</title>
</head>

<body>
    
    <?php
    echo "処理開始<br>";
    //記入例；以下はで挟まれるPHP領域に記載すること。
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！

    
    $dsn = 'mysql:dbname=tb23****db;host=localhost';
    $user = 'tb-23****';
    $password = '**********';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //記入例；以下はで挟まれるPHP領域に記載すること。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    $sql ='SHOW CREATE TABLE tbtest';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        //2つめの内容はテーブルの構成（・で作ったカラム）
        echo $row[1];
    }
    echo "<hr>";
    
    
    echo "処理終了";
    ?>

</body>
<!--CREATE 文を実行する mission で作成したSQLと比べると「なんとなく似ているけど、ちょっと違う（ややこしく書いてあるっぽい）」ものが出力されました。
実はSQLには「本当はこのように記述するが、簡略化した書き方でもOK」なものが幾つかあります。
たとえばカラム名は「 `id` 」のように「``」でくくるのが厳密で正確なのですが、くくる表記自体が省略可能です。
当インターンではこの厳密な書き方まで覚える必要はありません。自分が書いたSQLと比べて、要所は同じだと読み取れればOKです。-->
</html>