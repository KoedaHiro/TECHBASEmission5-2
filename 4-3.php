<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-3テーブルの閲覧</title>
</head>

<body>
    
    <?php
    echo "処理開始<br><hr>";
    //記入例；以下はで挟まれるPHP領域に記載すること。
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！

    
    $dsn = 'mysql:dbname=tb23****db;host=localhost';
    $user = 'tb-23****';
    $password = '**********';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //記入例；以下は挟まれるPHP領域に記載すること。
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    
    //テーブルを確認する
    $sql ='SHOW TABLES';
    //↑で定義した操作を＄pdoで実行
    $result = $pdo -> query($sql);
    //$resultの操作で出てきた結果の列ごとに操作次の操作を繰り返す
    foreach ($result as $row){
        //1つめの内容はテーブルの名前
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";
    
    
    echo "処理終了";
    ?>

</body>
<!--mission_4-2で「tbtest」というテーブルを1個作成しています。つまりテーブルは1個だけが存在しています。
そのため現時点では、上記のような結果となります。
たとえば、「tbtest」という名前で CREATE し、続けて「tbtest_123」「tbtest_456」、という名前で CREATE していれば結果は
　tbtest
　tbtest_123
　tbtest_456
というように、作成したテーブルが並んで表示されます。
-->
</html>