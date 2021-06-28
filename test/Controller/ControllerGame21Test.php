<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Mos\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        //session_start();
        $controller = new Game21();

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
        $controller = new Game21();
        $_POST["dice"] = 2;

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->handle();
        $this->assertInstanceOf($exp, $res);
    }

    /**
    * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction2()
    {
        $controller = new Game21();
        $_SESSION["rounds"] = 2;

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->handle();
        $this->assertInstanceOf($exp, $res);
    }
}
