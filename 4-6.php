<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-6全表示</title>
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
    
     //記入例；挟まれるPHP領域に記載すること。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    //$rowの添字（[ ]内）は、4-2で作成したカラムの名称に併せる必要があります。
    
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
    
    echo "処理終了";
    ?>

</body>
<!--「 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) 」とは、
データベース操作でエラーが発生した場合に警告（Worning: ）として
表示するために設定するオプションです。-->
</html>