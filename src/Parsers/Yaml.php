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

    private function stripContent(string $content)
    {
        $content = substr($content, 0, strpos($content, '---', strpos($content, '---')+1));
        $content = str_replace('---', '', $content);
        return $content;
    }
}