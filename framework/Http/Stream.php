<?php

namespace Framework\Http;

use Psr\Http\Message\StreamInterface;
use RuntimeException;

// TODO: WRITTEN BY AI SHOULD CHECK IT LATER
class Stream implements StreamInterface
{
    /** @var resource|null */
    private $stream;

    private bool $seekable;
    private bool $readable;
    private bool $writable;
    private ?array $meta;
    private ?int $size = null;
    private ?string $uri;

    public function __construct($stream, string $mode = 'r')
    {
        if (is_string($stream)) {
            $resource = fopen($stream, $mode);
            if ($resource === false) {
                throw new RuntimeException('The stream could not be opened.');
            }
            $this->stream = $resource;
        } elseif (is_resource($stream)) {
            $this->stream = $stream;
        } else {
            throw new \InvalidArgumentException('Invalid stream provided. It must be a stream resource or a file path.');
        }

        $this->meta = stream_get_meta_data($this->stream);
        $this->seekable = $this->meta['seekable'] ?? false;
        $this->readable = isset($this->meta['mode']) ? (strpos($this->meta['mode'], 'r') !== false || strpos($this->meta['mode'], '+') !== false) : false;
        $this->writable = isset($this->meta['mode']) ? (strpos($this->meta['mode'], 'w') !== false || strpos($this->meta['mode'], 'a') !== false || strpos($this->meta['mode'], 'x') !== false || strpos($this->meta['mode'], 'c') !== false || strpos($this->meta['mode'], '+') !== false) : false;
        $this->uri = $this->getMetadata('uri');
    }

    public function __destruct()
    {
        $this->close();
    }

    public function __toString(): string
    {
        try {
            $this->seek(0);
            return $this->getContents();
        } catch (RuntimeException $e) {
            return '';
        }
    }

    public function close(): void
    {
        if (isset($this->stream)) {
            if (is_resource($this->stream)) {
                fclose($this->stream);
            }
            $this->detach();
        }
    }

    public function detach()
    {
        if (!isset($this->stream)) {
            return null;
        }

        $result = $this->stream;
        unset($this->stream);
        $this->size = null;
        $this->uri = null;
        $this->readable = $this->writable = $this->seekable = false;

        return $result;
    }

    public function getSize(): ?int
    {
        if ($this->size !== null) {
            return $this->size;
        }

        if (!isset($this->stream)) {
            return null;
        }

        $stats = fstat($this->stream);
        if (isset($stats['size'])) {
            $this->size = $stats['size'];
            return $this->size;
        }

        return null;
    }

    public function tell(): int
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }

        $result = ftell($this->stream);

        if ($result === false) {
            throw new RuntimeException('Unable to determine stream position');
        }

        return $result;
    }

    public function eof(): bool
    {
        return !$this->stream || feof($this->stream);
    }

    public function isSeekable(): bool
    {
        return $this->seekable;
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        if (!$this->seekable || !isset($this->stream)) {
            throw new RuntimeException('Stream is not seekable');
        }

        if (fseek($this->stream, $offset, $whence) === -1) {
            throw new RuntimeException('Unable to seek to stream position');
        }
    }

    public function rewind(): void
    {
        $this->seek(0);
    }

    public function isWritable(): bool
    {
        return $this->writable;
    }

    public function write(string $string): int
    {
        if (!$this->writable || !isset($this->stream)) {
            throw new RuntimeException('Cannot write to a non-writable stream');
        }

        $this->size = null;
        $result = fwrite($this->stream, $string);

        if ($result === false) {
            throw new RuntimeException('Unable to write to stream');
        }

        return $result;
    }

    public function isReadable(): bool
    {
        return $this->readable;
    }

    public function read(int $length): string
    {
        if (!$this->readable || !isset($this->stream)) {
            throw new RuntimeException('Cannot read from non-readable stream');
        }

        $string = fread($this->stream, $length);

        if (false === $string) {
            throw new RuntimeException('Unable to read from stream');
        }

        return $string;
    }

    public function getContents(): string
    {
        if (!$this->isReadable()) {
            throw new RuntimeException('Stream is not readable');
        }

        $contents = stream_get_contents($this->stream);

        if ($contents === false) {
            throw new RuntimeException('Unable to read stream contents');
        }

        return $contents;
    }

    public function getMetadata(?string $key = null)
    {
        if (!isset($this->stream)) {
            return $key ? null : [];
        }

        $this->meta = stream_get_meta_data($this->stream);

        if ($key === null) {
            return $this->meta;
        }

        return $this->meta[$key] ?? null;
    }
}
