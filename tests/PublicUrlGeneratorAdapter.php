<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate\Tests;

use League\Flysystem\Config;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use League\Flysystem\UnableToGeneratePublicUrl;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;

final class PublicUrlGeneratorAdapter extends InMemoryFilesystemAdapter implements PublicUrlGenerator
{
    private $fp;

    public function publicUrl(string $path, Config $config): string
    {
        $this->fp = tmpfile();
        try {
            stream_copy_to_stream($this->readStream($path, $config), $this->fp);
        } catch (UnableToReadFile $e) {
            throw new UnableToGeneratePublicUrl($e->getMessage(), $path);
        }
        rewind($this->fp);

        return stream_get_meta_data($this->fp)['uri'];
    }
}
