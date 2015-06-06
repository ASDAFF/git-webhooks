## Установка через composer

Используйте composer для управления зависимостями и установкой модуля

``` bash
composer require citfact/git-webhooks
```

## Пример использования

```yaml
work_dir: ./
repo_name: author/test
scripts:
  - git reset --hard HEAD
  - git pull origin master
  - composer install
  - npm install
  - bower install
  - gulp dist
```

``` php
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Citfact\GitWebHooks\WebHook\BitbucketWebHook;
use Citfact\GitWebHooks\Workflow;
use Citfact\GitWebHooks\DeployConfig;

$logger = new Logger('WebHook Channel');
$logger->pushHandler(new StreamHandler('./your.log'));

$webHook = new BitbucketWebHook(json_decode($_POST['payload']));
$deploy = new DeployConfig('./webhook.yml');

$workflow = new Workflow($webHook, $deploy, $logger);
$workflow->process();
```