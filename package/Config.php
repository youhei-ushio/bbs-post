<?php
declare(strict_types=1);

// 設定管理クラス
final class Config
{
    // 投稿データ保存フォルダ
    public $postsDirectory = __DIR__ . '/../posts';

    // ログインユーザ情報保存ファイル
    public $usersFilename = __DIR__ . '/../users.txt';

    // ログインユーザ名
    public $user = 'user!!!';

    // ログインパスワード
    public $password = 'password!!!';
}
