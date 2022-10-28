<?php

declare(strict_types=1);

namespace Ajgl\Flysystem\Replicate;

use BadMethodCallException;
use DateTimeInterface;
use League\Flysystem\ChecksumProvider;
use League\Flysystem\Config;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\UnableToGeneratePublicUrl;
use League\Flysystem\UnableToGenerateTemporaryUrl;
use League\Flysystem\UnableToProvideChecksum;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;

/**
 * @internal
 */
trait ReplicateFilesystemAdapterTrait
{
    private FilesystemAdapter $replica;

    private FilesystemAdapter $source;

    public function __construct(FilesystemAdapter $source, FilesystemAdapter $replica)
    {
        $this->source = $source;
        $this->replica = $replica;
    }

    public function getSourceAdapter(): FilesystemAdapter
    {
        return $this->source;
    }

    public function getReplicaAdapter(): FilesystemAdapter
    {
        return $this->replica;
    }

    public function fileExists(string $path): bool
    {
        return $this->source->fileExists($path);
    }

    public function directoryExists(string $path): bool
    {
        if (!method_exists($this->source, 'directoryExists')) {
            throw new BadMethodCallException('Require "league/flysystem:^3" to use this method.');
        }

        return $this->source->directoryExists($path);
    }

    public function write(string $path, string $contents, Config $config): void
    {
        $this->source->write($path, $contents, $config);
        $this->replica->write($path, $contents, $config);
    }

    public function writeStream(string $path, $contents, Config $config): void
    {
        $this->source->writeStream($path, $contents, $config);
        $replicaContents = $this->ensureSeekable($contents, $path);
        $this->replica->writeStream($path, $replicaContents, $config);
    }

    /**
     * Rewinds the stream, or returns the source stream if not seekable.
     *
     * @param resource $resource The resource to rewind.
     *
     * @return resource A stream set to position zero.
     */
    private function ensureSeekable($resource, string $path)
    {
        if (stream_get_meta_data($resource)['seekable'] && rewind($resource)) {
            return $resource;
        }

        return $this->source->readStream($path);
    }

    public function read(string $path): string
    {
        return $this->source->read($path);
    }

    public function readStream(string $path)
    {
        return $this->source->readStream($path);
    }

    public function delete(string $path): void
    {
        $this->source->delete($path);

        if ($this->replica->fileExists($path)) {
            $this->replica->delete($path);
        }
    }

    public function deleteDirectory(string $path): void
    {
        $this->source->deleteDirectory($path);
        $this->replica->deleteDirectory($path);
    }

    public function createDirectory(string $path, Config $config): void
    {
        $this->source->createDirectory($path, $config);
        $this->replica->createDirectory($path, $config);
    }

    public function setVisibility(string $path, string $visibility): void
    {
        $this->source->setVisibility($path, $visibility);
        $this->replica->setVisibility($path, $visibility);
    }

    public function visibility(string $path): FileAttributes
    {
        return $this->source->visibility($path);
    }

    public function mimeType(string $path): FileAttributes
    {
        return $this->source->mimeType($path);
    }

    public function lastModified(string $path): FileAttributes
    {
        return $this->source->lastModified($path);
    }

    public function fileSize(string $path): FileAttributes
    {
        return $this->source->fileSize($path);
    }

    public function listContents(string $path, bool $deep): iterable
    {
        return $this->source->listContents($path, $deep);
    }

    public function move(string $source, string $destination, Config $config): void
    {
        $this->source->move($source, $destination, $config);
        $this->replica->move($source, $destination, $config);
    }

    public function copy(string $source, string $destination, Config $config): void
    {
        $this->source->copy($source, $destination, $config);
        $this->replica->copy($source, $destination, $config);
    }

    public function publicUrl(string $path, Config $config): string
    {
        if (!interface_exists(PublicUrlGenerator::class)) {
            throw new BadMethodCallException('Require "league/flysystem:^3" to use this method.');
        }

        if (!$this->source instanceof PublicUrlGenerator) {
            throw new UnableToGeneratePublicUrl(sprintf('Source adapter must implements "%s" to use this method.', PublicUrlGenerator::class), $path);
        }

        return $this->source->publicUrl($path, $config);
    }

    public function temporaryUrl(string $path, DateTimeInterface $expiresAt, Config $config): string
    {
        if (!interface_exists(TemporaryUrlGenerator::class)) {
            throw new BadMethodCallException('Require "league/flysystem:^3" to use this method.');
        }

        if (!$this->source instanceof TemporaryUrlGenerator) {
            throw new UnableToGenerateTemporaryUrl(sprintf('Source adapter must implements "%s" to use this method.', TemporaryUrlGenerator::class), $path);
        }

        return $this->source->temporaryUrl($path, $expiresAt, $config);
    }

    public function checksum(string $path, Config $config): string
    {
        if (!interface_exists(ChecksumProvider::class)) {
            throw new BadMethodCallException('Require "league/flysystem:^3" to use this method.');
        }

        if (!$this->source instanceof ChecksumProvider) {
            throw new UnableToProvideChecksum(sprintf('Source adapter must implements "%s" to use this method.', ChecksumProvider::class), $path);
        }

        return $this->source->checksum($path, $config);
    }
}
