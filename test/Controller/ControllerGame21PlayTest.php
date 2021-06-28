<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerGame21PlayTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21play();
        $this->assertInstanceOf("\Mos\Controller\Game21play", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        //session_start();
        $controller = new Game21play();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);
    }

    /**
    * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction()
    {
        $controller = new Game21play();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->handle();
        $this->assertInstanceOf($exp, $res);
    }
}
