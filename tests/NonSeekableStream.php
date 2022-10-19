<?php

namespace Ajgl\Flysystem\Replicate\Tests;

class NonSeekableStream
{
    public function stream_open($uri, $mode, $options, &$opened_path)
    {
        return true;
    }

    public function stream_seek($offset, $whence = SEEK_SET)
    {
        return false;
    }

    public function stream_eof()
    {
        return false;
    }
}
