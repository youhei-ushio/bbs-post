<?php
declare(strict_types=1);

require_once __DIR__ . '/../Authenticator.php';
require_once __DIR__ . '/LoginPage.php';

final class InputPage
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
                <p><a href='/index.php?action=logout'>ログアウト</a></p>
                <form method='post' action='/index.php?action=save'
                <label>
                    ニックネーム
                    <input type='text' name='nickname'>
                </label>
                <br>
                <label>
                    タイトル
                    <input type='text' name='title'>
                </label>
                <br>
                <label>
                    本文
                    <textarea name='body'></textarea>
                </label>
                <br>
                <button type='submit'>保存</button>
            </body>
        </html>";
    }
}
