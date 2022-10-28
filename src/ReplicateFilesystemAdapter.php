<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate;

use League\Flysystem\ChecksumProvider;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;

if (interface_exists(TemporaryUrlGenerator::class)) {
    final class ReplicateFilesystemAdapter implements FilesystemAdapter, PublicUrlGenerator, ChecksumProvider, TemporaryUrlGenerator
    {
        use ReplicateFilesystemAdapterTrait;
    }
} elseif (interface_exists(ChecksumProvider::class)) {
    final class ReplicateFilesystemAdapter implements FilesystemAdapter, PublicUrlGenerator, ChecksumProvider
    {
        use ReplicateFilesystemAdapterTrait;
    }
} elseif (interface_exists(PublicUrlGenerator::class)) {
    final class ReplicateFilesystemAdapter implements FilesystemAdapter, PublicUrlGenerator
    {
        use ReplicateFilesystemAdapterTrait;
    }
} else {
    final class ReplicateFilesystemAdapter implements FilesystemAdapter
    {
        use ReplicateFilesystemAdapterTrait;
    }
}
