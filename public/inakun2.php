<?php       //ユーザー登録完了画面
//..は一個上の階層
require_once '../class/inakun.php';
//エラーメッセージ
$err = [];//配列にエラーメッセージ入れる

//正しい形式のデータであるか規定道理か//バリデーション
//INPUT_POST=POSTで受け取ったデータ表示、filter_input=postで送られたもの_指定した名前の変数を外部から受け取る
if(!$username = filter_input(INPUT_POST, 'username')) {
    $err[] = 'ユーザ名を記入してください。';
}

if(!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = 'メールアドレスを記入してください。';
}

$password = filter_input(INPUT_POST, 'password');
//正規表現・・・短く略すこと
if(!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
    $err[] = 'パスワードは英数字8文字以上100文字以下にしてください';
}
if("/[a-z]*")

$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf) {
    $err[] = '確認用パスワードと異なっています。';
}

if(count($err) === 0) {
    // $hasCreated = UserLogic::createUser($_POST);//$_POSTでformから受け取った値を入れる、hasCreateに入れて入ってるか確認
    //$errが0だった場合ユーザーを登録する処理
    $hasCreated = new UserLogic();//$_POSTでformから受け取った値を入れる、hasCreateに入れて入ってるか確認
    $a = $hasCreated->createUser($_POST);

    if(!$a) {
        $err[] = '登録に失敗しました。';
        var_dump($err);
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了画面</title>
</head>
<body>
    <!--エラーがあればエラーを全部出してくれるなければ完了-->
    <?php if(count($err) > 0) : ?>
        <?php foreach($err as $e) : ?>
            <p><?php echo $e ?></p>
        <?php endforeach ?>
    <?php else : ?>
        <p>ユーザー登録完了しました！</p>
    <?php endif ?>
    <a href="./signUp.php">戻る</a>
</body>
</html>