## Web Development 2

### How To Start:

1. Make a folder on your local pc
2. Download Rocket Idea project https://github.com/kevileem2/rocketidea/
3. In terminal or cmd, locate root folder of rocket idea project
4. Execute **npm install** in terminal or cmd
5. Execute **composer install** in terminal or cmd
6. Execute **php artisan key:generate** in terminal or cmd
7. Make a .env file in root
```javascript

APP_NAME=rocketidea
APP_ENV=local
APP_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.X.X
DB_PORT=3306
DB_DATABASE=rocketidea
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.X.X
REDIS_PASSWORD=null
REDIS_PORT=6379

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```
8. Your php.ini file extensions:
```ini
memory_limit = 8G
post_max_size = 6G
;extension_dir = "./"
; On windows:
extension_dir = "ext"
upload_max_filesize = 4G
extension=curl
extension=fileinfo
extension=gd2
extension=mbstring
extension=mysqli
extension=openssl
extension=pdo_mysql
extension=pdo_sqlite
extension=sockets
extension=xmlrpc
