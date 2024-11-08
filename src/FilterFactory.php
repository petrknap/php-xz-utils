<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\ExternalFilter\Filter;

enum FilterFactory
{
    case Lzma;
    case Xz;

    /**
     * @todo check platform and return different command for Windows
     *
     * @return non-empty-string
     */
    private function command(): string
    {
        return match ($this) {
            FilterFactory::Xz => 'xz',
            FilterFactory::Lzma => 'lzma',
        };
    }

    /**
     * @param array<non-empty-string> $options
     */
    public function compress(
        int|null $compressionPreset = null,
        array $options = []
    ): Filter {
        $options = ['--compress', ...$options];
        if ($compressionPreset !== null) {
            $options[] = '-' . $compressionPreset;
        }
        return new Filter($this->command(), $options);
    }

    /**
     * @param array<non-empty-string> $options
     */
    public function decompress(
        array $options = [],
    ): Filter {
        $options = ['--decompress', ...$options];
        return new Filter($this->command(), $options);
    }
}
