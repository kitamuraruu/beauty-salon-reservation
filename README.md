# 美容院予約システム

## 概要
CodeIgniter 4を使用した美容院予約システムです。

## 機能
- 顧客向け予約登録
- 管理者向け予約管理
- ログイン認証システム

## 環境構築手順

### 1. 必要な環境
- PHP 8.1以上
- MySQL 8.x
- Apache 2.4
- Composer

### 2. インストール手順

#### XAMPPを使用する場合（推奨）
1. XAMPPをダウンロード・インストール
2. ApacheとMySQLを起動
3. プロジェクトをhtdocsに配置
4. データベースを作成

#### 手動インストールの場合
1. PHP、MySQL、Apacheをインストール
2. Composerをインストール
3. プロジェクトをクローン
4. 依存関係をインストール

### 3. データベース設定
1. MySQLでデータベースを作成
2. マイグレーションを実行
3. テストデータを挿入

### 4. 設定ファイル
`.env.example`を`.env`にコピーしてデータベース接続情報を設定

## 使用方法

### ログイン情報
- 管理者: ID=admin, パスワード=admin
- 一般ユーザー: ID=user, パスワード=user

### アクセスURL
- トップページ: `http://localhost/beauty-salon-reservation/public/`
- 管理者ログイン: `http://localhost/beauty-salon-reservation/public/login`

## 技術スタック
- CodeIgniter 4
- PHP 8.1+
- MySQL 8.x
- HTML/CSS/JavaScript

## ライセンス
MIT License


