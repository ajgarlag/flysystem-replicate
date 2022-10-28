<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate\Tests;

use League\Flysystem\ChecksumProvider;
use League\Flysystem\Config;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use League\Flysystem\UnableToProvideChecksum;
use League\Flysystem\UnableToReadFile;

final class ChecksumProviderAdapter extends InMemoryFilesystemAdapter implements ChecksumProvider
{
    public function checksum(string $path, Config $config): string
    {
        try {
            $data = $this->read($path, $config);
        } catch (UnableToReadFile $e) {
            throw new UnableToProvideChecksum($e->getMessage(), $path);
        }

        return md5($data);
    }
}
