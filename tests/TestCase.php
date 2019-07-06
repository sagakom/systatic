<?php

namespace Tests;

use Damcclean\Systatic\Systatic;
use PHPUnit\Framework\TestCase as Base;

define('BASE', './tests/fixtures');
define('CONFIGURATION', './tests/fixtures/config.php');

class TestCase extends Base
{
    public function setUp() : void
    {
        parent::setUp();
    }
}