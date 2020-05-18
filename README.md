# Teste Siffra

Este é uma aplicação de teste

## Installation

Baixar o repositório
Configurar o .env


```bash

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:4/6nHVUCYsylh2Xy+G2lWwAP+oLrMjE97bjraSz83m0=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=usarname
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=redis
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=email_padrao
MAIL_FROM_NAME="${APP_NAME}"

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


No terminal:

```bash
composer install
php artisan migrate

php artisan passport:install
```

## Usage
Para esta aplicação, foi utilizado o serviso mailtrap para teste de envio de emails.
Basta acessar https://mailtrap.io/ e se cadastrar, inserir o username e password gerado para teste no arquivo .env


```bash
php artisan serve
```

###Pusher
Em resources/views/welcome.blade.php, trocar o token de acesso ao pusher pelo cadastrado em:
```bash
    var pusher = new Pusher('8acae47b14cd6acea139', {
      cluster: 'us2'
    });
```
Alterar o .env com os dados do pusher.
Rodar o comando:
```bash
    php artisan queue:listen
```


###Login
Para usar o login, primeiro rodar o seeder  com o seguinte comando:
```bash
    php artisan db:seed
```
Na sequência, em resources/views/welcome.blade.php, alterar o valor de client_secret pelo valor da tabela oauth_clients


###Email com horizon
Rodar o seguinte comando para tarefas:
```bash
    php artisan queue:work
```

