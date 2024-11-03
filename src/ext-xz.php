<?php

declare(strict_types=1);

if (!function_exists('xzencode')) {
    /**
     * @see gzencode()
     * @see PetrKnap\XzUtils\Xz::compress()
     */
    function xzencode(string $data, int|null $compressionPreset = null): string|false
    {
        try {
            return (new PetrKnap\XzUtils\Xz())->compress($data, $compressionPreset);
        } catch (Throwable) {
            return false;
        }
    }
}

if (!function_exists('xzdecode')) {
    /**
     * @see gzdecode()
     * @see PetrKnap\XzUtils\Xz::decompress()
     */
    function xzdecode(string $data): string|false
    {
        try {
            return (new PetrKnap\XzUtils\Xz())->decompress($data);
        } catch (Throwable) {
            return false;
        }
    }
}
