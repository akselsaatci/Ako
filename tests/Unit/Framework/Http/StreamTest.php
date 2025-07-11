<?php

namespace Tests\Unit\Framework\Http;

use Framework\Http\Stream;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class StreamTest extends TestCase
{
    public function testConstructorInitializesProperties()
    {
        $handle = fopen('php://temp', 'r+');
        fwrite($handle, 'data');
        $stream = new Stream($handle);
        $this->assertTrue($stream->isReadable());
        $this->assertTrue($stream->isWritable());
        $this->assertTrue($stream->isSeekable());
        $this->assertEquals('php://temp', $stream->getMetadata('uri'));
        $this->assertIsArray($stream->getMetadata());
        $this->assertEquals(4, $stream->getSize());
        $this->assertFalse($stream->eof());
        $stream->close();
    }

    public function testStreamClosesHandleOnDestruct()
    {
        $handle = fopen('php://temp', 'r');
        $stream = new Stream($handle);
        unset($stream);
        $this->assertFalse(is_resource($handle));
    }

    public function testConvertsToString()
    {
        $handle = fopen('php://temp', 'w+');
        fwrite($handle, 'data');
        $stream = new Stream($handle);
        $this->assertEquals('data', (string) $stream);
        $stream->close();
    }

    public function testGetsContents()
    {
        $handle = fopen('php://temp', 'w+');
        fwrite($handle, 'data');
        rewind($handle);
        $stream = new Stream($handle);
        $this->assertEquals('data', $stream->getContents());
        $stream->close();
    }

    public function testChecksEof()
    {
        $handle = fopen('php://temp', 'w+');
        fwrite($handle, 'data');
        rewind($handle);
        $stream = new Stream($handle);
        $this->assertFalse($stream->eof());
        $stream->read(5);
        $this->assertTrue($stream->eof());
        $stream->close();
    }

    public function testGetSize()
    {
        $handle = fopen('php://temp', 'w+');
        fwrite($handle, 'data');
        $stream = new Stream($handle);
        $this->assertEquals(4, $stream->getSize());
        $stream->write('more');
        fseek($handle, 0, SEEK_END);
        $this->assertEquals(8, $stream->getSize());
        $stream->close();
    }

    public function testTell()
    {
        $handle = fopen('php://temp', 'w+');
        fwrite($handle, 'data');
        $stream = new Stream($handle);
        $stream->seek(2);
        $this->assertEquals(2, $stream->tell());
        $stream->close();
    }

    public function testDetach()
    {
        $handle = fopen('php://temp', 'w+');
        $stream = new Stream($handle);
        $this->assertSame($handle, $stream->detach());
        $this->assertNull($stream->detach());
        $this->assertFalse($stream->isReadable());
        $this->assertFalse($stream->isWritable());
        $this->assertFalse($stream->isSeekable());
    }

    public function testThrowsExceptionOnDetachedStream()
    {
        $handle = fopen('php://temp', 'w+');
        $stream = new Stream($handle);
        $stream->detach();

        $this->expectException(RuntimeException::class);
        $stream->read(10);
    }
}
