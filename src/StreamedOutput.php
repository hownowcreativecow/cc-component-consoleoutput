<?php
/**
 * @copyright 2018 Creative Cow Limited
 */
declare(strict_types=1);

namespace Cc\ConsoleOutput;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\StreamOutput;

class StreamedOutput extends StreamOutput
{

    /**
     * @var AnsiToHtmlConverter
     */
    protected $converter;

    /**
     * @inheritdoc
     */
    public function __construct(
        $stream,
        AnsiToHtmlConverter $converter,
        int $verbosity = self::VERBOSITY_NORMAL,
        bool $decorated = true,
        ?OutputFormatterInterface $formatter = null
    ) {
        parent::__construct($stream, $verbosity, $decorated, $formatter);
        $this->converter = $converter;
    }

    /**
     * @inheritdoc
     */
    protected function doWrite($message, $newline): void
    {
        $message = trim($message, "\x08 ");
        if ($message) {
            $message = $this->converter->convert($message) . '<br>';
        }
        if (false === @fwrite($this->getStream(), $message)) {
            // should never happen
            throw new RuntimeException('Unable to write output.');
        }

        fflush($this->getStream());
    }
}
