<?php

namespace Damcclean\Systatic\Import;

use Symfony\Component\Yaml\Yaml;
use Damcclean\Systatic\Config\Config;
use Illuminate\Filesystem\Filesystem;
use Damcclean\Systatic\Collections\Collections;

class Jekyll
{
    public function __construct()
    {
        $this->config = new Config();
        $this->filesystem = new Filesystem();
        $this->collections = new Collections();
    }

    public function import($folder)
    {
        $config = $this->parseConfig($folder);
        $data = $this->dataFiles($folder);
        $posts = $this->posts($folder);
        $contentFolders = $this->contentFolders($folder);

        return true;
    }

    public function parseConfig($folder)
    {
        $configFile = $folder . '/_config.yml';

        if (! file_exists($configFile)) {
            return false;
        }

        $configSettings = Yaml::parseFile($configFile);

        foreach ($configSettings as $key => $value) {
            if ($key == 'title') {
                $configSettings['name'] = $configSettings['title'];
                unset($configSettings['title']);
            }
        }

        return $this->config->updateArray($configSettings);
    }

    public function dataFiles($folder)
    {
        $dataDirectory = $folder . '/_data';

        if (! file_exists($dataDirectory)) {
            return false;
        }

        $files = [];

        $files = array_merge(
            glob(
                $dataDirectory . '/*.yml',
                GLOB_BRACE
            ),
            $files
        );

        foreach ($files as $file) {
            $array = Yaml::parseFile($file);
            $config = $this->config->updateArray($array);
        }

        return true;
    }

    public function posts($folder)
    {
        $postsDirectory = $folder . '/_posts';

        if (! file_exists($postsDirectory)) {
            return false;
        }

        $files = [];

        $files = array_merge(
            glob(
                $postsDirectory . '/*.md',
                GLOB_BRACE
            ),
            $files
        );

        $this->collections->create('posts', 'Posts', '/', './content/posts');

        foreach ($files as $file) {
            $this->filesystem->copy($file, './content/posts/' . basename($file));
        }

        return true;
    }

    public function contentFolders($folder)
    {
        $directories = [];

        $directories = array_merge(
            glob(
                $folder . '/*',
                GLOB_ONLYDIR
            ),
            $directories
        );

        foreach ($directories as $directory) {
            if (! strpos($directory, '_')) {
                $baseDirectoryName = basename($directory);

                $this->collections->create(strtolower($baseDirectoryName), ucfirst($baseDirectoryName), '/', './content/' . strtolower($baseDirectoryName));

                $files = [];

                $files = array_merge(
                    glob(
                        $directory . '/*.md',
                        GLOB_BRACE
                    ),
                    $files
                );

                foreach ($files as $file) {
                    $this->filesystem->copy($file, './content/' . strtolower($baseDirectoryName) . '/' . basename($file));
                }
            }
        }

        return true;
    }
}
