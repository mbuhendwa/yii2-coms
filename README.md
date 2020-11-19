# Yii2 simple sales system

1. Clone repository
        
        git clone https://github.com/mbuhendwa/yii2-coms.git

2. Install all envireonment requirements (PHP7, composer, php extensions) then all packages

        composer update

3. Create MySQL database named 'coms'

4. Migrations

        php yii migrate

5. Initialize database

        mysql -h localhost -u <mysql_user> -p coms < db_init.sql

5. Run app

        php yii serve --docroot="frontend/web/" // for frontend app
        php yii serve --docroot="backend/web/" // for backend app
        