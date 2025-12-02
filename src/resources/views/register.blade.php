<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>FashionablyLate - Register</title>
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-title">FashionablyLate</h1>
            <a class="login-link" href="{{ route('login') }}">login</a>
        </div>
    </header>

    <main>
        <div class="page-title">
            <h2>Register</h2>
        </div>

        <section class="register-section">
            <form class="register-form" action="/register" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">お名前</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田　太郎">
                    @error('name')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

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
                    <button type="submit" class="btn-primary">登録</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
