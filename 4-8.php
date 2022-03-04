<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-8削除</title>
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
    
    echo "処理終了";
    
     //記入例；挟まれるPHP領域に記載すること。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    $id = 2;
    $sql = 'delete from tbtest where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


    //続けて、4-6の SELECTで表示させる機能 も記述し、表示もさせる。
    //※ データベース接続は上記で行っている状態なので、その部分は不要
    
    ?>

</body>
<!--「 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) 」とは、
データベース操作でエラーが発生した場合に警告（Worning: ）として
表示するために設定するオプションです。-->
</html>