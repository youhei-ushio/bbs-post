<?php
declare(strict_types=1);

require_once __DIR__ . '/Config.php';

// 認証管理クラス
final class Authenticator
{
    private $users;

    // 現在ログイン中であればtrue、ログインしていなければfalseを返す
    public function isLoggedIn()
    {
        $this->load();
        // ユーザ一覧に現在アクセス中のIPアドレスがあればログイン済みとみなす
        return in_array($_SERVER['REMOTE_ADDR'], $this->users);
    }

    // ログイン
    public function login()
    {
        // 必要なパラメータが不足している場合はログイン画面を出す
        if (!array_key_exists('user', $_POST) || $_POST['user'] === '') {
            $loginPage = new LoginPage();
            $loginPage->show();
            return;
        }
        if (!array_key_exists('password', $_POST) || $_POST['password'] === '') {
            $loginPage = new LoginPage();
            $loginPage->show();
            return;
        }

        $config = new Config();
        if ($_POST['user'] === $config->user && $_POST['password'] === $config->password) {
            // Configにあるユーザ名とパスワードと一致したらログイン成功とする
            // 現在アクセス中のIPアドレスをユーザ一覧へ保存する
            $this->load();
            $this->users[] = $_SERVER['REMOTE_ADDR'];
            $this->save();

            // ログイン成功後は入力画面を出す
            $inputPage = new InputPage();
            $inputPage->show();
            return;
        } else {
            // ログイン失敗時はログイン画面を出す
            $loginPage = new LoginPage();
            $loginPage->show();
            return;
        }
    }

    // ログアウト
    public function logout()
    {
        // まず現在のユーザ一覧を読み込む
        $this->load();

        // 現在アクセス中のIPアドレスをユーザ一覧から除く
        foreach ($this->users as $key => $user) {
            if ($user === $_SERVER['REMOTE_ADDR']) {
                unset($this->users[$key]);
                $this->save();
                break;
            }
        }

        // ログアウト後はログイン画面を出す
        $loginPage = new LoginPage();
        $loginPage->show();
        return;
    }

    // ユーザ一覧を保存する
    private function save()
    {
        // Configからユーザ情報保存フォルダの位置を特定
        $config = new Config();

        $data = implode("\n", $this->users);
        file_put_contents($config->usersFilename, $data);
    }

    // ユーザ一覧を読み込む
    private function load()
    {
        // Configからユーザ情報保存フォルダの位置を特定
        $config = new Config();

        // ファイルがなければ読まずに空のユーザ一覧をセットする
        if (!file_exists($config->usersFilename)) {
            $this->users = [];
            return;
        }

        // ユーザ情報ファイルを読み、中身のデータを改行コードで分割する
        $data = file_get_contents($config->usersFilename);
        $this->users = explode("\n", $data);
    }
}
