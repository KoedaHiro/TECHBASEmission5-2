<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charest="UFT-8">
    <title>mission_4-5書き込み</title>
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
    $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $name = 'A';
    $comment = 'こんばんは!'; //好きな名前、好きな言葉は自分で決めること
    $sql -> execute();
    //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
    
    
    
    echo "処理終了";
    ?>

</body>
<!--このプログラムを実行するごとに、データが1件ずつ登録されます。このデータ1件を「レコード」と呼びます。
mission_4-6 以降は、登録したレコードに対して色んな操作を行います。
その準備としてこのプログラムを何度も実行する事になりますが、この時 上記（好きな名前）（好きなコメント）の部分をちょっと変更しておくと、データの区別がつきやすくなります。
また、ちょっと掲示板のイメージもつかめますよ-->
</html>