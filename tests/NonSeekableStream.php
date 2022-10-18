<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate\Tests;

class NonSeekableStream
{
    public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool
    {
        return true;
    }

    public function stream_read(int $count): string
    {
        return '';
    }

    public function stream_eof(): bool
    {
        return true;
    }

    public function stream_seek(int $offset, int $whence = SEEK_SET): bool
    {
        return false;
    }

    public function stream_stat(): array
    {
        return [];
    }
}
