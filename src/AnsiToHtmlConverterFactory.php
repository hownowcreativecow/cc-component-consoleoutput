<?php
/**
 * @copyright 2018 Creative Cow Limited
 */
declare(strict_types=1);

namespace Cc\ConsoleOutput;

use Interop\Container\ContainerInterface;
use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use SensioLabs\AnsiConverter\Theme\Theme;
use Zend\ServiceManager\Factory\FactoryInterface;

class AnsiToHtmlConverterFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AnsiToHtmlConverter
    {
        return new $requestedName($container->get(Theme::class), false);
    }
}
