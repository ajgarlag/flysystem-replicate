<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate;

use League\Flysystem\FilesystemAdapter;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;

if (interface_exists(PublicUrlGenerator::class)) {
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
