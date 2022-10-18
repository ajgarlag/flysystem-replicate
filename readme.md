# Flysystem Adapter for Replication.

This package is forked from the original [`league/flysystem-replicate-adapter`](https://packagist.org/packages/league/flysystem-replicate-adapter) written by [@frankdejonge](https://github.com/frankdejonge). The objective is to provide support for Flysystem V2 and V3

## Installation

```bash
composer require ajgl/flysystem-replicate
```

## Usage

```php
$source = new League\Flysystem\Adapter\AwsS3(...);
$replica = new League\Flysystem\Adapter\Local(...);
$adapter = new Ajgl\Flysystem\Replicate\ReplicateAdapter($source, $replica);
```

What's cool about this is that you can chain them to replicate to more then 1 other storage system.


```php
$adapter = new Ajgl\Flysystem\Replicate\ReplicateAdapter($source, $replica);

$anotherReplica = new League\Flysystem\Adapter\Dropbox(...);
$adapter = new Ajgl\Flysystem\Replicate\ReplicateAdapter($adapter, $anotherReplica);
```


## Migration from `league/flysystem-replicate-adapter`

Edit your `composer.json` file and change your requirement:

```diff
--- original/composer.json      2022-10-18 09:41:52.035899136 +0200
+++ migrated/composer.json      2022-10-18 09:42:31.792011593 +0200
@@ -1,5 +1,5 @@
 {
     "require": {
-        "league/flysystem-replicate-adapter": "^1.0"
+        "ajgl/flysystem-replicate": "^1.0"
     }
 }
```

`League\Flysystem\Replicate\ReplicateAdapter` class is deprecated. Is recommended to change any reference to `Ajgl\Flysystem\Replicate\ReplicateAdapter`.
