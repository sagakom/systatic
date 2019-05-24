<?php

namespace Tests;

use PHPUnit\Framework\TestCase as Base;

/*
    Set config file
    - Set the config file for the tests, as we don't have a console file to do this for us
*/

define('CONFIG', './tests/site/config.php');

class TestCase extends Base
{
    //
}