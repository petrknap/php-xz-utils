<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

final class XzTest extends XzUtilsTestCase
{
    protected static function getInstance(): XzUtils
    {
        return new Xz();
    }

    protected static function getCompressedDataAsBase64(): array
    {
        return [
            'default' => '/Td6WFoAAATm1rRGAgAhARYAAAB0L+WjAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla',
            '0' => '/Td6WFoAAATm1rRGAgAhAQwAAACPmEGcAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla',
            '9' => '/Td6WFoAAATm1rRGAgAhARwAAAAQz1jMAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla',
        ];
    }
}
