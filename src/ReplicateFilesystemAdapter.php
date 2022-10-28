<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate;

use League\Flysystem\FilesystemAdapter;

final class ReplicateFilesystemAdapter implements FilesystemAdapter
{
    use ReplicateFilesystemAdapterTrait;
}
