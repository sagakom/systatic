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
        $contents = preg_replace('/---/', '=====', $contents, 1);   // Replace first --- with --
        $contents = substr(strstr($contents, '---'), strlen('---'));   // Remove everything before ---

        return $contents;
    }
}