<?php
namespace Radar\Adr\Router;

class MapTest extends \PHPUnit_Framework_TestCase
{
    protected $map;

    public function setup()
    {
        $this->map = new Map(new Route());
    }

    public function testRoute()
    {
        $route = $this->map->route('Foo', '/foo');
        $this->assertSame('Radar\Adr\Input', $route->input);
        $this->assertNull($route->domain);
        $this->assertSame('Radar\Adr\Responder\Responder', $route->responder);

        $route = $this->map->route('Bar', '/bar', 'BarDomain');
        $this->assertSame('Radar\Adr\Input', $route->input);
        $this->assertSame('BarDomain', $route->domain);
        $this->assertSame('Radar\Adr\Responder\Responder', $route->responder);
    }

    public function testRouteMagic()
    {
        $route = $this->map->route('Radar\Adr\Fake\Action', '/fake', 'Radar\Adr\FakeDomain');
        $this->assertSame('Radar\Adr\Fake\Action\Input', $route->input);
        $this->assertSame('Radar\Adr\Fake\Action\Responder', $route->responder);
        $this->assertSame(['foo/bar'], $route->accepts);
    }
}
