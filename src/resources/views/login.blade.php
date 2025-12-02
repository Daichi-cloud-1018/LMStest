<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>FashionablyLate - Login</title>
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-title">FashionablyLate</h1>
            <a class="register-link" href="/register">register</a>
        </div>
    </header>

    <main>
        <div class="page-title">
            <h2>Login</h2>
        </div>

        <section class="login-section">
            <form class="login-form" action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" name="password" placeholder="例: coachtech1106">
                    @error('password')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">ログイン</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
