# XZ Utils (wrapper)

User-friendly wrapper for XZ Utils, providing simplified and streamlined access to powerful data compression and decompression tools.
For ease of use, you can use the approach known from the [compression extensions](https://www.php.net/manual/en/refs.compression.php):
```php
$encoded = xzencode(b'data') or throw new Exception();
$decoded = xzdecode($encoded) or throw new Exception();
```

---

Run `composer require petrknap/xz-utils` to install it.
You can [support this project via donation](https://petrknap.github.io/donate.html).
The project is licensed under [the terms of the `LGPL-3.0-or-later`](./COPYING.LESSER).
