<?php
/**
 * @copyright 2018 Creative Cow Limited
 */
declare(strict_types=1);

namespace Cc\ConsoleOutput;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use SensioLabs\AnsiConverter\Theme\Theme;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigProvider
{

    /**
     * Get configuration
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases'    => [
                    OutputInterface::class => StreamedOutput::class,
                ],
                'invokables' => [
                    Theme::class => Theme::class,
                ],
                'factories'  => [
                    AnsiToHtmlConverter::class => AnsiToHtmlConverterFactory::class,
                    StreamedOutput::class      => StreamedOutputFactory::class,
                ],
            ],
        ];
    }
}
