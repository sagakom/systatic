<?php

namespace Tests;

use Tests\TestCase;
use Damcclean\Systatic\Compiler\BladeCompiler;

class CompilerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->blade = new BladeCompiler();
    }

    //
}