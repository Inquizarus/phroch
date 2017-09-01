<?php
namespace Botty\Test\Controller;

use PHPUnit\Framework\TestCase;
use \Botty\Controller\IndexController;
use \Symfony\Component\HttpFoundation\{Response, Request};

class IndexControllerTest extends TestCase
{
    /**
    * @test
    **/
    public function testItReturnsAnResponse()
    {
        $controller = new IndexController();
        $response = $controller->getIndex(new Request());
        $this->assertInstanceOf(Response::class, $response);
    }
}
