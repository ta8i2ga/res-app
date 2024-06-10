# 飲食店予約サービス
このアプリケーションは、飲食店の予約と管理を便利に行うことができる総合的な予約サービスです。ユーザーは簡単に飲食店の情報を検索し、お気に入り登録や予約管理を行うことができます。また、管理者は飲食店の詳細情報や予約情報を効率的に管理できる専用の管理画面も備えています。

## 主な機能
* 会員登録・ログイン・ログアウト
  
![スクリーンショット 2024-06-09 200939](https://github.com/ta8i2ga/res-app/assets/143866963/5070b28b-b624-47be-9277-bcf64152ba69)
![スクリーンショット 2024-06-09 200953](https://github.com/ta8i2ga/res-app/assets/143866963/32a2f052-5bb9-428b-9dbd-5eefc801498b)
![スクリーンショット 2024-06-09 201016](https://github.com/ta8i2ga/res-app/assets/143866963/e73f55ea-1771-4706-a82b-5f5f22f83006)
![スクリーンショット 2024-06-09 201037](https://github.com/ta8i2ga/res-app/assets/143866963/11c5b745-f370-4675-9017-8d00abbb7630)

* 飲食店の一覧や詳細情報を取得
  
![スクリーンショット 2024-06-09 201057](https://github.com/ta8i2ga/res-app/assets/143866963/fb4117dc-ac9f-4b3b-8103-296accf682f1)
![スクリーンショット 2024-06-09 202117](https://github.com/ta8i2ga/res-app/assets/143866963/2d2e22f1-da76-4153-b5c7-be503aa9ee30)

* 予約機能
  
![スクリーンショット 2024-06-09 202219](https://github.com/ta8i2ga/res-app/assets/143866963/8fa9fc2b-cdf4-4d4d-ad24-e1272bf7e96d)
![スクリーンショット 2024-06-09 202233](https://github.com/ta8i2ga/res-app/assets/143866963/4c2fbf6e-6fc5-47ac-a5a3-fff56db8e432)

* お気に入り、予約情報の管理、レビュー機能
  
![スクリーンショット 2024-06-09 202254](https://github.com/ta8i2ga/res-app/assets/143866963/f628b7d1-ffa0-4aed-b1b7-44af89487cb5)
![スクリーンショット 2024-06-09 202331](https://github.com/ta8i2ga/res-app/assets/143866963/6d05c92c-da98-4889-87ff-1bf0494bcfe8)
![スクリーンショット 2024-06-09 211048](https://github.com/ta8i2ga/res-app/assets/143866963/6221ada0-0dca-45f7-abcb-a2681bc0e8be)

* 管理者、店舗代表者専用、店舗情報管理画面
  
![スクリーンショット 2024-06-09 202440](https://github.com/ta8i2ga/res-app/assets/143866963/ee0ff44e-dcf7-488d-9ef7-1e521844c5e2)
![スクリーンショット 2024-06-09 202552](https://github.com/ta8i2ga/res-app/assets/143866963/51fa9c33-4e8c-4dda-a5b9-bafbe7a5f12f)
![スクリーンショット 2024-06-09 202612](https://github.com/ta8i2ga/res-app/assets/143866963/82575a4f-baee-4005-be0e-3de67f3d1c95)

## 作成目的
上級模擬案件の為

## 機能一覧
* 会員登録
* ログイン
* ログアウト
* ユーザー情報取得
* ユーザー飲食店お気に入り一覧取得
* ユーザー飲食店予約情報取得
* 飲食店一覧取得
* 飲食店詳細取得
* 飲食店お気に入り追加
* 飲食店お気に入り削除
* 飲食店予約情報追加
* 飲食店予約情報削除
* エリアで検索する
* ジャンルで検索する
* 店名で検索する
* 予約変更機能
* 評価機能
* バリデーション
* レスポンシブデザイン
* 管理画面
* ストレージ

## 使用技術
* Laravel Framework 8.83.27
* mysql :8.0.26
* PHP 7.4.9 

## テーブル設計
![スクリーンショット 2024-06-09 203202](https://github.com/ta8i2ga/res-app/assets/143866963/76c2ca18-768a-46ae-afe7-2e11946e201b)
![スクリーンショット 2024-06-09 203219](https://github.com/ta8i2ga/res-app/assets/143866963/82ddd69e-671f-4afc-b4b9-f34ac52bc89f)
![スクリーンショット 2024-06-09 203234](https://github.com/ta8i2ga/res-app/assets/143866963/b6184c84-8394-4349-bd7f-1a9bf1671fbe)

## ER図
![スクリーンショット 2024-06-09 195433](https://github.com/ta8i2ga/res-app/assets/143866963/f5b82f4a-8301-4d00-b667-2c81eda411b6)

## 環境構築
* docker-compose up -d --build
* docker-compose exec php bash
* composer install
* composer require laravel/fortify
* php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
* php artisan migrate
* composer require laravel-lang/lang:~7.0 --dev
* cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/

## アカウントの種類
管理者
* メールアドレス：admin@example.com
* パスワード：admin1234

店舗代表者
* メールアドレス：shopowner0@example.com
* パスワード：password123
  
店舗代表者メールアドレスは初期登録されている店舗分存在しますので、メールアドレスの「0」の数字の部分を変更してログインしてください。0～19の20店舗分あります。

## 追加実装ストレージについて
店舗情報を変更する画面にて画像を選択し、更新するボタンを押しますと一つの店舗につき最大で20枚までストレージに保存されるようになっているだけで、店舗のトップ画像を変更することはできません。
