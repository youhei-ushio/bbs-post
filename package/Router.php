<?php
declare(strict_types=1);

require_once __DIR__ . '/Authenticator.php';
require_once __DIR__ . '/pages/InputPage.php';
require_once __DIR__ . '/Posts.php';

// 処理振り分けクラス
final class Router
{
    public function run()
    {
        // actionの初期値をinputにしておく
        $action = 'input';
        if (array_key_exists('action', $_GET) && $_GET['action'] !== '') {
            // actionの指定があればセットする
            $action = $_GET['action'];
        }

        if ($action === 'input') {
            $inputPage = new InputPage();
            $inputPage->show();
        } elseif ($action === 'login') {
            $authenticator = new Authenticator();
            $authenticator->login();
        } elseif ($action === 'logout') {
            $authenticator = new Authenticator();
            $authenticator->logout();
        } elseif ($action === 'save') {
            $posts = new Posts();
            $posts->save();
        } else {
            // どのアクションにも該当しない場合はめんどくさいので適当にエラー出して終わる
            echo 'ERROR!';
            exit;
        }
    }
}
