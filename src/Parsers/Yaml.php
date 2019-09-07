<?php

namespace Damcclean\Systatic\Parsers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml
{
    public function parse(string $contents)
    {
        $contents = $this->stripContent($contents);

        return SymfonyYaml::parse($contents);
    }

    private function stripContent(string $contents)
    {
        $contents = substr($contents, 0, strpos($contents, '---', strpos($contents, '---') + 1));
        $contents = str_replace('---', '', $contents);

        return $contents;
    }
}
