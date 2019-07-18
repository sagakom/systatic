<?php

namespace Tests;

use Damcclean\Systatic\Filesystem\Filesystem;

class FilesystemTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->filesystem = new Filesystem();
    }

    public function testCanCreateFile()
    {
        $file = './tests/fixtures/storage/filesystem-test/file.txt';

        $create = $this->filesystem->createFile($file);

        $this->assertFileExists($file);
    }

    public function testCanCreateDirectory()
    {
        $directory = './tests/fixtures/storage/filesystem-test/directory';

        $create = $this->filesystem->createDirectory($directory);

        $this->assertFileExists($directory);
    }

    public function testCanCopyFile()
    {
        $source = './tests/fixtures/storage/filesystem-test/source.txt';
        $destination = './tests/fixtures/storage/filesystem-text/destination.txt';

        $create = $this->filesystem->copy($source, $destination);

        $this->assertFileExists($destination);
    }

    public function testCanCopyDirectory()
    {
        $source = './tests/fixtures/storage/filesystem-test/source';
        $destination = './tests/fixtures/storage/filesystem-test/destination';

        $create = $this->filesystem->copyDirectory($source, $destination);

        $this->assertFileExists($destination);
    }

    public function testCanAppendToFile()
    {
        $file = './tests/fixtures/storage/filesystem-test/joe.txt';

        file_write_contents($file, '');

        $create = $this->filesystem->append($file, 'Something');

        $this->assertSame('Something', file_get_contents($file));
    }

    public function testCanDumpToFile()
    {
        $file = './tests/fixtures/storage/filesystem-test/file.txt';

        $create = $this->filesystem->dump($file, 'Cool dude');

        $this->assertSame('Cool dude', file_get_contents($file));
    }

    public function testCanRenameFile()
    {
        $old = './tests/fixtures/storage/filesystem-test/file.txt';
        $new = './tests/fixtures/storage/filesystem-test/new.txt';

        $create = $this->filesystem->rename($old, $new);

        $this->assertFileExists($new);
    }

    public function testCanDeleteFile()
    {
        $file = './tests/fixtures/storage/filesystem-test/new.txt';

        $create = $this->filesystem->delete($file);

        $this->assertFileNotExists($file);
    }
}
