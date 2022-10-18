# Changelog

## Unreleased

### Removed

* Drop support for PHP < 7.4

## 1.0.2 - 2022-10-18

### Added

* Add `Ajgl\Flysystem\Replicate\ReplicateAdapter` class.

### Changed

* Move ReplicateAdapter to new namespace.

### Deprecated

* Deprecate `League\Flysystem\Replicate\ReplicateAdapter` class

## 1.0.1 - 2015-08-18

### Fixed

* [ReplicateAdapter] Now rewinds streams appropriately during writeStream and updateStream.
