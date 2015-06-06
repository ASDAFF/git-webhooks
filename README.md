GitWebHooks [![Build Status](https://secure.travis-ci.org/studiofact/git-webhooks.png)](http://travis-ci.org/studiofact/git-webhooks)
====

Простой автоматический деплой

## Установка через composer

Используйте composer для управления зависимостями и установкой модуля

``` bash
composer require citfact/git-webhooks
```

## Пример использования

```yaml
work_dir: ./
repo_name: author/test
script:
  - git reset --hard HEAD
  - git pull origin master
  - composer install -q
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

$webHook = new BitbucketWebHook(json_decode($_POST['payload'], true));
$deploy = new DeployConfig('./webhook.yml');

$workflow = new Workflow($webHook, $deploy, $logger);
$workflow->process();
```
