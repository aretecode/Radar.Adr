<?php
namespace Radar\Adr\Handler;

use Aura\Di\ContainerBuilder;
use Phly\Http\Response;
use Phly\Http\ServerRequestFactory;
use Radar\Adr\Factory;
use Radar\Adr\Router\Route;

class ActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected $actionHandler;

    protected function setUp()
    {
        $builder = new ContainerBuilder();
        $di = $builder->newInstance();
        $this->actionHandler = new ActionHandler(
            new Factory($di->getInjectionFactory())
        );
    }

    protected function assertResponse(Route $route, $expectStatus, $expectHeaders, $expectBody)
    {
        $request = ServerRequestFactory::fromGlobals();
        $request = $request->withAttribute('radar/adr:route', $route);
        $response = $this->actionHandler->__invoke(
            $request,
            new Response(),
            function ($request, $response) { return $response; }
        );
        $this->assertEquals($expectStatus, $response->getStatusCode());
        $this->assertEquals($expectBody, $response->getBody()->__toString());
        $this->assertEquals($expectHeaders, $response->getHeaders());
    }

    public function testDomainClass()
    {
        $route = new Route();
        $route->domain('Radar\Adr\Fake\FakeDomain');

        $this->assertResponse(
            $route,
            200,
            [
                'Content-Type' => [
                    'application/json',
                ],
            ],
            '{"domain":"value"}'
        );
    }

    public function testDomainArray()
    {
        $route = new Route();
        $route->domain(['Radar\Adr\Fake\FakeDomain', '__invoke']);

        $this->assertResponse(
            $route,
            200,
            [
                'Content-Type' => [
                    'application/json',
                ],
            ],
            '{"domain":"value"}'
        );
    }

    public function testDomainObject()
    {
        $route = new Route();
        $route->domain(new \Radar\Adr\Fake\FakeDomain());

        $this->assertResponse(
            $route,
            200,
            [
                'Content-Type' => [
                    'application/json',
                ],
            ],
            '{"domain":"value"}'
        );
    }

}
