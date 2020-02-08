<?php
declare(strict_types=1);

require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/pages/InputPage.php';
require_once __DIR__ . '/pages/SaveCompletedPage.php';

final class Posts
{
    public function save()
    {
        // 必要なパラメータが不足している場合はログイン画面を出す
        if (!array_key_exists('nickname', $_POST) || $_POST['nickname'] === '') {
            $inputPage = new InputPage();
            $inputPage->show();
            return;
        }
        if (!array_key_exists('title', $_POST) || $_POST['title'] === '') {
            $inputPage = new InputPage();
            $inputPage->show();
            return;
        }
        if (!array_key_exists('body', $_POST) || $_POST['body'] === '') {
            $inputPage = new InputPage();
            $inputPage->show();
            return;
        }

        // 設定から投稿データ保存フォルダを取得し、ファイル名は{日時}.txtとする
        $config = new Config();
        $timestamp = date('Ymdhis');
        $filename = "{$config->postsDirectory}/{$timestamp}.txt";
        // 各データはパイプ記号で区切る
        file_put_contents($filename, "{$_POST['nickname']}|{$_POST['title']}|{$_POST['body']}");

        // 保存後は完了画面を出す
        $saveCompletedPage = new SaveCompletedPage();
        $saveCompletedPage->show();
        return;
    }
}
