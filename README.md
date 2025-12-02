# LMStest
# FashionablyLate (お問い合わせ管理)

## 環境構築

1. 依存インストール・環境準備

    docker compose up -d --build
    docker compose exec php bash
    composer install
    cp .env.example .env
    php artisan key:generate
    ```
2. マイグレーション
    ```bash
    php artisan migrate
    php php db:seed
    ```

## 使用技術（実行環境）
- PHP 8.2.29
- Laravel 12.40.2
- Laravel Fortify 1.x
- MySQL 8.4
- Nginx latest

## 機能
- 問い合わせフォーム送信（バリデーション済み、確認画面→送信→サンクス）
- 問い合わせ一覧・検索・ページネーション（管理画面）
- 問い合わせ詳細モーダル表示
- 問い合わせCSVエクスポート（検索条件を引き継ぎ）
- ユーザー登録/ログイン/ログアウト（Fortify）

## 認証
- ログイン: email / password の必須・形式チェック、日本語メッセージ。
- 登録: name / email（ユニーク） / password の必須チェック、日本語メッセージ。
- ログアウト: Fortify の `/logout` に POST。ログアウト後は `/login` へリダイレクト。

## 主要画面
- `/` 問い合わせフォーム
- `/confirm` 確認画面（POST）
- `/thanks` サンクス画面（POST）
- `/login` ログイン
- `/register` ユーザー登録
- `/admin` 管理画面（一覧・検索・詳細モーダル・エクスポート）

## URL
- お問い合わせ http://localhost
- 会員登録 http://localhost/register
- 管理画面 http://localhost/admin


## ER図

