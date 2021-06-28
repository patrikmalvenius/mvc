<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Yatzy();
        $this->assertInstanceOf("\Mos\Controller\Yatzy", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        //session_start();
        $controller = new Yatzy();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);
    }

    /**
    * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction1()
    {
        $controller = new Yatzy();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->handlepost();
        $this->assertInstanceOf($exp, $res);
    }

    /**
    * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction2()
    {
        $controller = new Yatzy();
        $_SESSION["score"] = 1;

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->handlepost();
        $this->assertInstanceOf($exp, $res);
    }
}
