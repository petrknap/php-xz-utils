# XZ Utils (wrapper)

User-friendly wrapper for [XZ Utils](https://github.com/tukaani-project/xz), providing simplified and streamlined access to powerful data compression and decompression tools.
For ease of use, you can use the approach known from the [compression extensions](https://www.php.net/manual/en/refs.compression.php):
```php
$encoded = xzencode(b'data') or throw new Exception();
$decoded = xzdecode($encoded) or throw new Exception();

printf('`%s` was decoded from encoded base64(`%s`)', $decoded, base64_encode($encoded));
```

## Object-based approach

All functionality is available object-wise through the classes [`Lzma`](./src/Lzma.php) and [`Xz`](./src/Xz.php).

```php
$xz = new PetrKnap\XzUtils\Xz();
$compressed = $xz->compress(b'data');
$decompressed = $xz->decompress($compressed);

printf('`%s` was decompressed from compressed base64(`%s`)', $decompressed, base64_encode($compressed));
```

### Filter-based approach

For more complex use cases, a filter-based approach is also possible.

```php
use PetrKnap\ExternalFilter\Filter;
use PetrKnap\XzUtils\FilterFactory;

$file = fopen('README.md', 'r');
$xzFile = tmpfile();

# compress file to file
FilterFactory::xz()->compress()->filter(input: $file, output: $xzFile);

fclose($file);
rewind($xzFile);

# decompress file, filter headline and print it
print FilterFactory::xz()->decompress()->pipe(new Filter('head', ['-n', '1']))->filter($xzFile);

fclose($xzFile);
```

---

Run `composer require petrknap/xz-utils` to install it.
You can [support this project via donation](https://petrknap.github.io/donate.html).
The project is licensed under [the terms of the `LGPL-3.0-or-later`](./COPYING.LESSER).
