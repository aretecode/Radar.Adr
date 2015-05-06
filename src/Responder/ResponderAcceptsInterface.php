<?php
namespace Radar\Adr\Responder;

use Aura\Payload_Interface\PayloadInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ResponderAcceptsInterface
{
    public static function accepts();
}
