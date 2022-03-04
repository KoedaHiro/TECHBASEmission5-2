<!DOCTYPE html>
<html lang="ja">
    
    <head>
        <meta charset = "UFT-8">
        <title>mission_5-1</title>
    </head>
    
    <body>
<?php
    echo "<hr>";
    echo "処理開始<br>";
//DB接続（自分のアカウントで！）
    $dsn = 'mysql:dbname=tb23＊＊＊＊db;host=localhost';
    $user = 'tb-23＊＊＊＊';
    $password = '＊＊＊＊＊＊＊＊＊＊';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
//テーブルの作成
    $sql = "CREATE TABLE IF NOT EXISTS tb001"//テーブル名を指定してなければtb001を作るという操作
    ." ("//ここからどんなカラムを作るか書いていく
    . "id INT AUTO_INCREMENT PRIMARY KEY,"//idは整数列（INT）として定義
    . "name varchar(20),"//名前は最大文字数20まで
    . "comment TEXT,"//コメントは無制限（全部無制限にするとデータ過多になるから注意！）
    . "date  varchar(20), "
    . "pw  varchar(20) "
    .");";//カラムの指定終了
    $stmt = $pdo->query($sql);//20行目の操作を実行
    
    $date = date("Y/m/d H:i:s");
            
    //新規投稿・編集
            if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["new_pw"])){
                $name = $_POST["name"];
                $comment = $_POST["comment"];
                $pw1 = $_POST["new_pw"];
                
    // 編集  
                if(!empty($_POST["hidden_number"])){
                    $edit_num = $_POST["hidden_number"];
                    $id = $edit_num;//整列数idは編集番号
                    echo "<b>投稿番号".$edit_num."を編集します。</b><br>";
                    //DB編集
                    //操作を文字で置く　＝　’編集する　テーブル名　カラムの内容＝引数として定義 where　idが合うデータで編集を行う　
                    $sql = 'UPDATE tb001 SET name=:name,comment=:comment, date=:date, pw=:pw WHERE id=:id';
                    //操作開始
                    $stmt = $pdo->prepare($sql);
                    //$stmt->bindParam('カラム', 置き換える内容の文字, PDO::パラメータの種類);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                        $stmt->bindParam(':pw', $pw1, PDO::PARAM_STR);
                    $stmt->execute();
                    echo "編集終了";
    //新規投稿        
                }else{
                    //DB新規投稿
                    //$DB接続先→入力する　テーブル名　カラム　引数を定義
                    $sql = $pdo -> prepare("INSERT INTO tb001 (name, comment, date, pw) VALUES (:name, :comment, :date, :pw)");
                        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                        $sql -> bindParam(':pw', $pw1, PDO::PARAM_STR);
                    $sql -> execute();
                    echo "<b>投稿を受け付けました。</b><br>";
                    echo "新規投稿終了";
                }
                
            }elseif(empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["new_pw"])){
                echo "<b>名前が入力されていません</b>";
                
                
            }elseif(!empty($_POST["name"]) && empty($_POST["comment"]) && !empty($_POST["new_pw"])){
                echo "<b>コメントが入力されていません</b>";
                
                
            }elseif(!empty($_POST["name"]) && !empty($_POST["comment"]) && empty($_POST["new_pw"])){
                echo "<b>パスワードが入力されていません</b>"; 
                
                
// 削除指定→削除   
            }elseif(!empty($_POST["delete_number"]) && !empty($_POST["delete_pw"])){
                $del_num = $_POST["delete_number"]; 
                $pw2 = $_POST["delete_pw"];
                $id = $del_num;
                
                //DB読み取り、削除
                $sql = 'SELECT * FROM tb001';//読み取り操作を定義
                $stmt = $pdo->query($sql);//↑の操作を実行
                $results = $stmt->fetchAll();//読み取り実行して出てきた内容を定義
                foreach ($results as $row){//読み取った内容を内容ごとに(idごとに)＄rowとしてループ
                    if($row['pw'] == $pw2 && $row['id'] == $id) {//もし投稿番号とパスワードが一致するものがあったら
                        $sql = 'delete from tb001 where id=:id';//指定のidを消す
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();    
                    }
                } echo "<b>投稿番号".$del_num."が削除されました。</b><br>";
                echo "削除終了";
                
            }elseif(empty($_POST["delete_number"]) && !empty($_POST["delete_pw"])){
                echo "<b>削除番号が入力されていません</b>";
                
            }elseif(!empty($_POST["delete_number"]) && empty($_POST["delete_pw"])){
                echo "<b>パスワードが入力されていません</b>";
               
//編集指定    
            }else{
                if(!empty($_POST["edit_number"]) && !empty($_POST["edit_pw"])){
                    $edit_num = $_POST["edit_number"];//【定義】編集番号
                    $pw3 = $_POST["edit_pw"];
                //DB読みとり    
                    $sql = 'SELECT * FROM tb001';
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll();
                    foreach ($results as $row){
                        if($row['id'] == $edit_num && $row['pw'] == $pw3) {
                                $edit_name = $row['name'];
                                $edit_com = $row['comment'];
                                $edit_pw = $row['pw'];
                        }    
                    }
                    echo "<b>番号". $edit_num ."を編集しようとしています</b>";
                    echo "編集指定終了";
                        
                    
                }elseif(empty($_POST["edit_number"]) && !empty($_POST["edit_pw"])){
                    echo "<b>編集番号が入力されていません</b>";
                    
                }elseif(!empty($_POST["edit_number"]) && empty($_POST["edit_pw"])){
                    echo "<b>パスワードが入力されていません</b>";
                }
            }
        ?>
        <!--ここより上でフォームを作ると編集名と編集コメント定義されてないって言われる-->
        <form action ="" method ="post">
            <input type ="text" name ="name" placeholder ="名前" 
                    value = "<?php if(isset($edit_name)){echo $edit_name ;} ?>"><!--【条件】編集名があるときには編集名が入る-->
                    
            <input type ="text" name ="comment" placeholder ="コメント" 
                    value = "<?php if(isset($edit_com)){echo $edit_com ;} ?>"><!--【条件】編集コメントがあるときには編集コメントが入る-->
            <input type ="text" name ="new_pw" placeholder ="パスワード" 
                    value = "<?php if(isset($edit_pw)){echo $edit_pw ;} ?>"><!--【条件】編集pwがあるときには編集コメントが入る-->
                    
            <input type ="hidden" name ="hidden_number" placeholder ="隠し編集番号" 
                    value = "<?php if(isset($edit_num)){echo $edit_num ;} ?>"><!--【条件】編集番号があるときには編集番号が入る-->
                    
            <button type = "submit" name ="button1" value ="submitbutton" >送信</button>
        </form>
        
        <br>
        <form action ="" method ="post">
            <input type ="number" name ="delete_number" placeholder ="削除番号">
            <input type ="text" name ="delete_pw" placeholder ="パスワード">
            <button type = "submit" name ="button2" value ="submitbutton" >削除</button> 
        </form>
        
        <br>
        <form action ="" method ="post">
            <input type ="number" name ="edit_number" placeholder ="編集対象番号">
            <input type ="text" name ="edit_pw" placeholder ="パスワード">
            <button type = "submit" name ="button3" value ="submitbutton" >編集</button>
        </form>

<?php
echo "<hr>";
echo "表示開始<br>";
echo "<hr>";
    $dsn = 'mysql:dbname=tb23＊＊＊＊db;host=localhost';
    $user = 'tb-23＊＊＊＊';
    $password = '＊＊＊＊＊＊＊＊＊＊';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //DB読み取り    
    $sql = 'SELECT * FROM tb001';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
        foreach ($results as $row){
            echo $row['id'].'.';
            echo $row['name'].'　「';
            echo $row['comment'].'」　';
            echo $row['date'].'<br>'; 
        }
echo "<hr>";
echo "表示終了";   
?>
    </body>
</html>