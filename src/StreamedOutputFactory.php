<?php
/**
 * @copyright 2018 Creative Cow Limited
 */
declare(strict_types=1);

namespace Cc\ConsoleOutput;

use Cc\OutputStream\SharedSocket;
use Interop\Container\ContainerInterface;
use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use Zend\ServiceManager\Factory\FactoryInterface;

class StreamedOutputFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): StreamedOutput
    {
        return new $requestedName(
            $container->get(SharedSocket::class)[SharedSocket::CHILD],
            $container->get(AnsiToHtmlConverter::class)
        );
    }
}
