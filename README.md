# Item Management 

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
   - ドラッグ＆ドロップで売上処理
   #### デモ（操作GIF）

    <p align="center">
     <img src="https://jp-item-managemen-kentasato-2b71506ac4e9.herokuapp.com/images/demo.gif" width="600" />
    </p>

5. **売上一覧・集計**
   - 売上データの確認、シンプルな売上集計を表示
   - 商品別や、日付で売上集計を表示

6. **在庫管理**
   - 在庫が0になると商品が売上登録できなくなるなどの制限機能あり

---

##  開発環境
#### PHP 8.2.0
#### Laravel 10.13.5
#### mysql  9.2.0

---

## システム閲覧
[アプリケーションページへ](https://jp-item-managemen-kentasato-2b71506ac4e9.herokuapp.com/)

###  テストアカウント情報
   - メールアドレス : test@test.com
   - パスワード：test1234

---

##  設計書

#### https://drive.google.com/drive/folders/1GKIgexkQTNyl_okYjvoiUP3Yu_c-iAgb?usp=sharing



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
