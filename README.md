#  laravelを使用したcms ecサイト<br >
公開側画面と管理側画面に分かれており、<br >
管理側画面にて公開側画面の情報を更新できます。

# URL
http://xxx <br >
http://xxx/admin <br >
xxxx。

# 使用技術

- PHP 8.1.28
- Laravel Framework 9.52.16
- mysql  Ver 8.0.37
- Apache
- bootstrap 5.2.3
  - html
  - css
  - jQuery
- さくらのvps（本番環境）
- Docker/Docker-compose（開発環境）

# 機能一覧

## 公開側
- ユーザー登録
- ログイン機能
- user登録
- カート機能
- お問い合わせ
- mypage
  - 住所管理機能
  - 購入履歴参照

## 管理側
- スタッフ管理
- 商品管理
- カテゴリ管理

## ジョブ(cron)
- DB情報の定期バックアップ

# テスト
- phpUnit
  - 単体テスト