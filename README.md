# Flysystem Adapter for Replication.

This package is forked from the original [`league/flysystem-replicate-adapter`](https://packagist.org/packages/league/flysystem-replicate-adapter) written by [@frankdejonge](https://github.com/frankdejonge). The objective is to provide support for Flysystem V2 and V3

> If you use Flysystem 1.x, use [ajgl/flysystem-replicate 1.x](https://github.com/ajgarlag/flysystem-replicate/tree/1.x)

## Installation

```bash
composer require ajgl/flysystem-replicate
```

## Usage

```php
$source = new League\Flysystem\AwsS3V3\AwsS3V3Adapter(...);
$replica = new League\Flysystem\Local\LocalFilesystemAdapter(...);
$adapter = new Ajgl\Flysystem\Replicate\ReplicateFilesystemAdapter($source, $replica);
```

What's cool about this is that you can chain them to replicate to more then 1 other storage system.


```php
$adapter = new Ajgl\Flysystem\Replicate\ReplicateFilesystemAdapter($source, $replica);

$anotherReplica = new League\Flysystem\WebDAV\WebDAVAdapter(...);
$adapter = new Ajgl\Flysystem\Replicate\ReplicateFilesystemAdapter($adapter, $anotherReplica);
```
