<?php

namespace Damcclean\Systatic\Parsers;

use ParsedownExtra as Parser;

class ParsedownExtra
{
    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function parse($contents)
    {
        return $this->parser->text($contents);
    }
}