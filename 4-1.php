<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-1接続</title>
</head>

<body>
    
    <?php
    echo "処理開始<br>";
    //記入例；以下はで挟まれるPHP領域に記載すること。
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！

    // DB接続設定
    
    $dsn = 'mysql:dbname=tb23****db;host=localhost';
    $user = 'tb-23****';
    $password = '**********';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    echo "処理終了";
    ?>

</body>
<!--「 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) 」とは、
データベース操作でエラーが発生した場合に警告（Worning: ）として
表示するために設定するオプションです。-->
</html>