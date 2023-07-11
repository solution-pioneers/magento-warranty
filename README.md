# Magento Warranty extension


## 1. How to install Magento Warranty

Add the following lines into your composer.json
 
```
"require":{
    ...
    "solution-pioneers/warranty":"{version}"
 }
```
or install via composer

```
composer require solution-pioneers/warranty
```

Then execute the following commands:

```
$ composer update
$ bin/magento setup:upgrade
$ bin/magento setup:static-content:deploy
```