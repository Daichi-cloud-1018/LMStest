<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <title>FashionablyLate - Confirm</title>
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
    </header>

    <main>
        <div class="page-title">
            <h2>Confirm</h2>
        </div>

        <section class="confirm-section">
            <form class="confirm-form" action="/thanks" method="post">
                @csrf
                <table class="confirm-table">
                    <tr>
                        <th>お名前</th>
                        <td>
                            <div class="name-group">
                                <input type="text" name="last_name" value="{{ $inputs['last_name'] }}" readonly>
                                <input type="text" name="first_name" value="{{ $inputs['first_name'] }}" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            @if ($inputs['gender'] == 1)
                            男性
                            @elseif ($inputs['gender'] == 2)
                            女性
                            @elseif ($inputs['gender'] == 3)
                            その他
                            @endif
                            <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <input type="text" name="email" value="{{ $inputs['email'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>
                            <input type="text" name="tel" value="{{ $inputs['tel'] }}" readonly>
                            <input type="hidden" name="phone_1" value="{{ $inputs['phone_1'] }}">
                            <input type="hidden" name="phone_2" value="{{ $inputs['phone_2'] }}">
                            <input type="hidden" name="phone_3" value="{{ $inputs['phone_3'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>
                            <input type="text" name="address" value="{{ $inputs['address'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>
                            <input type="text" name="building" value="{{ $inputs['building'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>
                            {{ $inputs['content'] }}
                            <input type="hidden" name="content" value="{{ $inputs['content'] }}">
                            <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>
                            <input type="textarea" name="detail" value="{{ $inputs['detail'] }}" readonly>
                        </td>
                    </tr>
                </table>

                <div class="confirm-buttons">
                    <button type="submit" class="btn-primary">送信</button>
                    <button type="submit" class="btn-secondary" formaction="/">修正</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
