<?php
declare(strict_types=1);

require_once __DIR__ . '/LoginPage.php';

// ログイン画面
final class LoginPage
{
    public function show()
    {
        echo "<html lang='ja'>
            <head><title>BBS LOGIN</title></head>
            <body>
                <form method='post' action='/index.php?action=login'
                <label>
                    ユーザ名
                    <input type='text' name='user'>
                </label>
                <br>
                <label>
                    パスワード
                    <input type='password' name='password'>
                </label>
                <br>
                <button type='submit'>ログイン</button>
            </body>
        </html>";
    }
}
