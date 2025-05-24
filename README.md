【環境構築】
1. Dockerビルド

① git clone git@github.com:estra-inc/confirmation-test-contact-form.git
② DockerDesktopアプリを立ち上げる
③ docker-compose up -d --build## 

2. Laravel環境構築

① docker-compose exec php bash
② composer install
③「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
④ .envに以下の環境変数を追加

 DB_CONNECTION=mysql
 DB_HOST=mysql
 DB_PORT=3306
 DB_DATABASE=laravel_db
 DB_USERNAME=laravel_user
 DB_PASSWORD=laravel_pass

④ アプリケーションキーの作成

 php artisan key:generate

⑤ マイグレーションの実行

 php artisan migrate
⑥ シーディングの実行

 php artisan db:seed

3. 主要技術

 言語・フレームワーク　　
　 MySQL：10.11.6 
 　php：8.4.2 
 　Laravel：11.44.2 
 　Docker：27.4.0 
 　PHPunit：11.5.12 

【ER図】

![image](https://github.com/user-attachments/assets/a08ec5e0-718a-4ede-8721-fc8139616ca0)



【URL】
開発環境：http://localhost/
phpMyAdmin:：http://localhost:8080/

