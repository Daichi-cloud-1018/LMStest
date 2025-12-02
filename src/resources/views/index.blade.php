<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>FashionablyLate</title>
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
    </header>

    <main>
        <div class="page-title">
            <h2>Contact</h2>
        </div>
        <form class="contact-form" action="/confirm" method="post">
            @csrf
            <div class="contact-form__name">
                <label class="form-label">お名前 <span class="required">※</span></label>
                <div class="contact-form__name-field">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田" aria-label="姓">
                    <input type="text" name="first_name" value="{{ old('first_name')}}" placeholder="例: 太郎" aria-label="名">
                </div>
                @error('last_name')
                <p class="error-text">{{ $message }}</p>
                @enderror
                @error('first_name')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-from__gender">
                <label class="form-label">性別 <span class="required">※</span></label>
                <div class="contact-form__gender-radio">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') === '3' ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__email">
                <label class="form-label">メールアドレス <span class="required">※</span></label>
                <input type="email" name="email" value="{{ old('email')}}" placeholder="例: test@example.com">
                @error('email')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__tel">
                <label class="contact-form__tel-label">電話番号 <span class="required">※</span></label>
                <div class="contact-form__tel-field">
                    <input type="text" name="phone_1" value="{{ old('phone_1') }}" placeholder="080" aria-label="電話番号1">
                    <span class="separator">-</span>
                    <input type="text" name="phone_2" value="{{ old('phone_2')}}" placeholder="1234" aria-label="電話番号2">
                    <span class="separator">-</span>
                    <input type="text" name="phone_3" value="{{ old('phone_3')}}" placeholder="5678" aria-label="電話番号3">
                </div>
                @error('phone_1')
                <p class="error-text">{{ $message }}</p>
                @enderror
                @error('phone_2')
                <p class="error-text">{{ $message }}</p>
                @enderror
                @error('phone_3')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__address">
                <label class="form-label">住所 <span class="required">※</span></label>
                <input type="text" name="address" value="{{ old('address')}}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                @error('address')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__address-building">
                <label class="form-label">建物名</label>
                <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>

            <div class="contact-form__category">
                <label class="form-label">お問い合わせの種類 <span class="required">※</span></label>
                <select name="content">
                    <option value="">選択してください</option>
                    <option value="商品のお届けについて" {{ old('content') === '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="商品の交換について" {{ old('content') === '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="商品トラブル" {{ old('content') === '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="ショップへのお問い合わせ" {{ old('content') === 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="その他" {{ old('content') === 'その他' ? 'selected' : '' }}>その他</option>

                </select>
                @error('content')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__message">
                <label class="form-label">お問い合わせ内容 <span class="required">※</span></label>
                <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail')}}</textarea>
                @error('detail')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="contact-form__button">
                <button type="submit" class="btn-primary">確認画面</button>
            </div>
        </form>
    </main>
</body>

</html>
