<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate\Tests;

use DateTimeInterface;
use League\Flysystem\Config;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use League\Flysystem\UnableToGenerateTemporaryUrl;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;

final class TemporaryUrlGeneratorAdapter extends InMemoryFilesystemAdapter implements TemporaryUrlGenerator
{
    private $fp;

    public function temporaryUrl(string $path, DateTimeInterface $expiresAt, Config $config): string
    {
        $this->fp = tmpfile();
        try {
            stream_copy_to_stream($this->readStream($path, $config), $this->fp);
        } catch (UnableToReadFile $e) {
            throw new UnableToGenerateTemporaryUrl($e->getMessage(), $path);
        }
        rewind($this->fp);

        return stream_get_meta_data($this->fp)['uri'];
    }
}
