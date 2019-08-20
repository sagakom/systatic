<?php

namespace Damcclean\Systatic\Parsers;

use ParsedownExtra as Parser;

class ParsedownExtra
{
    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function parse(string $contents)
    {
        $contents = $this->stripYaml($contents);
        return $this->parser->text($contents);
    }

    public function stripYaml(string $contents)
    {
         return preg_replace('/^(---(?s)(.*?)---)/i', '', $contents);
    }
}