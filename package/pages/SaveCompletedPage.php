<?php
declare(strict_types=1);

require_once __DIR__ . '/../Authenticator.php';
require_once __DIR__ . '/LoginPage.php';

// 投稿完了画面
final class SaveCompletedPage
{
    public function show()
    {
        // 認証していなければログイン画面を表示する
        $authenticator = new Authenticator();
        if (!$authenticator->isLoggedIn()) {
            $loginPage = new LoginPage();
            $loginPage->show();
            return;
        }

        echo "<html lang='ja'>
            <head><title>BBS</title></head>
            <body>
                <p>投稿データを保存しました。</p>
                <p><a href='/index.php?action=input'>投稿画面</a></p>
                <p><a href='/index.php?action=logout'>ログアウト</a></p>
            </body>
        </html>";
    }
}
