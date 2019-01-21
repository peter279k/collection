# Simple Collection for PHP 7.1+

[![Gitter](https://badges.gitter.im/sunrise-php/support.png)](https://gitter.im/sunrise-php/support)
[![Build Status](https://api.travis-ci.com/sunrise-php/collection.svg?branch=master)](https://travis-ci.com/sunrise-php/collection)
[![CodeFactor](https://www.codefactor.io/repository/github/sunrise-php/collection/badge)](https://www.codefactor.io/repository/github/sunrise-php/collection)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/collection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/collection/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sunrise-php/collection/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/collection/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/sunrise/collection/v/stable?format=flat)](https://packagist.org/packages/sunrise/collection)
[![Total Downloads](https://poser.pugx.org/sunrise/collection/downloads?format=flat)](https://packagist.org/packages/sunrise/collection)
[![License](https://poser.pugx.org/sunrise/collection/license?format=flat)](https://packagist.org/packages/sunrise/collection)

## Installation

```
composer require sunrise/collection
```

## How to use

```php
use Sunrise\Collection\Collection;

$payload = new Collection($_POST);

$payload->get('key', 'default');
```

## Api documentation

https://phpdoc.fenric.ru/
