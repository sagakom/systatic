<?php

namespace Damcclean\Systatic\Parsers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml
{
    public function parse($contents)
    {
        preg_match($this->regex, $contents, $matches);

        if(isset($matches[2])) {
            return SymfonyYaml::parse(trim($matches[2]));
        }

        return [];
    }
}