## Step 1 
 
 Clone the project  `git clone git@github.com:Gevorg618/jira-rest-api.git`

## Step 2 
  


 run `composer install`

## Step 3
 
 make `.env` file with following params
  
 		APP_NAME=Laravel
		APP_ENV=local
		APP_KEY=base64:MDxJXlpA1y8ZZ/T0IpwxXWfw5D/PKG+fdQXZhCwGh+0=
		APP_DEBUG=true
		APP_URL=http://localhost

		LOG_CHANNEL=stack
		LOG_DEPRECATIONS_CHANNEL=null
		LOG_LEVEL=debug

		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=laravel
		DB_USERNAME=root
		DB_PASSWORD=

		BROADCAST_DRIVER=log
		CACHE_DRIVER=file
		FILESYSTEM_DRIVER=local
		QUEUE_CONNECTION=sync
		SESSION_DRIVER=file
		SESSION_LIFETIME=120

		MEMCACHED_HOST=127.0.0.1

		REDIS_HOST=127.0.0.1
		REDIS_PASSWORD=null
		REDIS_PORT=6379

		MAIL_MAILER=smtp
		MAIL_HOST=mailhog
		MAIL_PORT=1025
		MAIL_USERNAME=null
		MAIL_PASSWORD=null
		MAIL_ENCRYPTION=null
		MAIL_FROM_ADDRESS=null
		MAIL_FROM_NAME="${APP_NAME}"

		AWS_ACCESS_KEY_ID=
		AWS_SECRET_ACCESS_KEY=
		AWS_DEFAULT_REGION=us-east-1
		AWS_BUCKET=
		AWS_USE_PATH_STYLE_ENDPOINT=false

		PUSHER_APP_ID=
		PUSHER_APP_KEY=
		PUSHER_APP_SECRET=
		PUSHER_APP_CLUSTER=mt1
		MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
		MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

		JIRA_HOST="https://test-work-domain.atlassian.net"
		JIRA_USER="gevo618@gmail.com"
		JIRA_PASS="PUPfoQMaheaBoHiuo1JZ46DC"


## Step 4 

 run `php artisan serve`

## Api Endpoints

POST::  http://127.0.0.1:8000/api/projects -  create jira project 
POST::  http://127.0.0.1:8000/api/issues -  create issue in jira project 
