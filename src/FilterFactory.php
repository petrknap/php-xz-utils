<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\ExternalFilter\Filter;

final class FilterFactory
{
    /**
     * @param non-empty-string $command
     */
    private function __construct(
        private readonly string $command,
    ) {
    }

    public static function lzma(): self
    {
        return new self('lzma');
    }

    public static function xz(): self
    {
        return new self('xz');
    }

    /**
     * @param array<non-empty-string>|null $options
     */
    public function compress(
        int|null $compressionPreset = null,
        array|null $options = null,
    ): Filter {
        $options = ['--compress', ...($options ?? [])];
        if ($compressionPreset !== null) {
            $options[] = '-' . $compressionPreset;
        }
        return new Filter($this->command, $options);
    }

    /**
     * @param array<non-empty-string>|null $options
     */
    public function decompress(
        array|null $options = null,
    ): Filter {
        $options = ['--decompress', ...($options ?? [])];
        return new Filter($this->command, $options);
    }
}
