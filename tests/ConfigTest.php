<?php
namespace Radar\Adr;

use Aura\Di\_Config\AbstractContainerTest;

class ConfigTest extends AbstractContainerTest
{
    protected function getConfigClasses()
    {
        return [
            'Radar\Adr\Config',
        ];
    }

    public function provideGet()
    {
        return [
            ['radar/adr:router', 'Aura\Router\RouterContainer'],
        ];
    }

    public function provideNewInstance()
    {
        return [
            ['Aura\Router\RouterContainer'],
            ['Radar\Adr\Adr'],
            ['Radar\Adr\Responder'],
            ['Radar\Adr\Map'],
            ['Radar\Adr\Handler\RoutingHandler'],
        ];
    }
}
