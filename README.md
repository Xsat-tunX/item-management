# Item Management 

**日本語に対応した商品管理Webアプリケーション**  
Heroku 上で一般公開中:  
⇨ https://jp-item-managemen-kentasato-2b71506ac4e9.herokuapp.com/

---

##  概要

個人経営の方むけの在庫管理と売上管理が行えるシステムになります。

---

##  主な機能

1. **ログイン・ログアウト機能**

2. **商品一覧**
   - 商品名、価格、在庫数の確認が可能
   - 商品の一覧表示・登録・編集・削除 

3. **商品登録／編集／削除**
   - 新規商品の追加、既存商品の編集・削除

4. **売上処理（ドラッグ＆ドロップ）**
   - 商品を売上欄に移動し、処理をおこなうと在庫数が減少
   - ドラッグ＆ドロップで簡単に売上処理（SortableJS 使用）

5. **売上一覧・集計**
   - 売上データの確認、シンプルな売上集計を表示
   - 商品別や、日付で売上集計を表示

6. **在庫管理**
   - 在庫が0になると商品が売上登録できなくなるなどの制限機能あり

---

##  開発環境


---

##  設計書

---

##  テストアカウント情報
   - メールアドレス : test@test.com
   - パスワード：test1234


##  使用技術

| 技術        | 説明                              |
|-------------|-----------------------------------|
| Laravel     | PHP製のWebアプリケーションフレームワーク |
| Blade       | Laravelのテンプレートエンジン           |
| SortableJS  | ドラッグ＆ドロップUIのライブラリ         |
| Bootstrap   | レスポンシブなスタイリングフレームワーク  |
| Heroku      | 本番環境のホスティングプラットフォーム   |
| MySQL/PostgreSQL | データベース                        |

---

##  ローカル開発環境セットアップ

```bash
# リポジトリをクローン
git clone https://github.com/yourusername/jp-item-management.git
cd jp-item-management

# 環境変数ファイルを設定
cp .env.example .env

# 依存パッケージをインストール
composer install
npm install && npm run dev

# アプリケーションキー生成
php artisan key:generate

# マイグレーションと初期データ
php artisan migrate --seed

# サーバーを起動
php artisan serve