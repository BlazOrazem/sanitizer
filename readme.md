Sanitizer
=========

Sanitizer is a package convenient for sanitizing proper names (names of persons, places, or certain special things), email addresses, URLs etc.


General features
----------------

 * Converts proper names (names of persons, places, or certain special things) to sanitized CamelCase format
 * Converts email addresses to sanitized lower-cased email format
 * Converts a string of characters to sanitized URL format


Features on URL sanitizing
--------------------------

 * Converts internal character encoding to UTF-8
 * Replaces accented characters with corresponding unaccented characters
 * Replaces Cyrillic script characters with corresponding Latin script characters
 * Replaces currency symbols
 * Replace other reserved, unsafe and special characters
 * Converts to lower-case, trims and returns sanitized URL string


Installation via Composer
-------------------------

Sanitizer is installable and auto-loadable via Composer as [blazorazem/sanitizer](https://packagist.org/packages/blazorazem/sanitizer/).

First include the Sanitizer package.
<pre>
"blazorazem/sanitizer": "dev-master"
</pre>

Now simply use the Sanitizer class.
<pre>
use BlazOrazem\Sanitizer;
</pre>


Stand-alone usage
-----------------

Download a release or clone this repository, then require or include its _src/Sanitizer.php_ file.


Basic Usage
-----------

CamelCase proper names (names of persons, places, or certain special things).
<pre>
Sanitizer::name('mr. chuck norris');
// Returns: Mr. Chuck Norris
</pre>

Validate and sanitize email address format.
<pre>
Sanitizer::email('CHUCK@norris.COM');
// Returns: chuck@norris.com

Sanitizer::email('CHUCK @norris?.COM');
// Returns: null

Sanitizer::email('CHUCK @norris?.COM');
// Returns: null
</pre>

Sanitize URL
<pre>
Sanitizer::url('this Shőüld be \n sąn`itiz˘ed /// web-safe STRING/ with € cú˘rrenc~y at THE...END');
// Returns: this-should-be-sanitized-/-web-safe-string/-with-eur-currency-at-the.end
</pre>

Convert accented characters
<pre>
Sanitizer::url('Ŵĥăţ ĩş ŷōuř ñąmĕ? Mý ŉǎmę ĭŝ Ĉħǚçķ Ñöŕŗǐś.');
// Returns: what-is-your-name-my-name-is-chuck-norris.
</pre>

Convert Cyrillic script URL to Latin script
<pre>
Sanitizer::url('Как вас зовут? Меня зовут Чхучк Норрис.');
// Returns: kak-vas-zovut-mena-zovut-chuck-norris.
</pre>


Requirements
------------

The Sanitizer package requires PHP 5.3 or later, and has no dependencies.


Support
-------

 * [Homepage](http://www.numencode.com/)
 * <info@numencode.com>


Authors
-------

 * Chief developer: Blaz Orazem <blaz@orazem.info>
 * Maintainer: Blaz Orazem <blaz@orazem.info>


License
-------

Sanitizer is issued under MIT license.

<pre>
Copyright (C) 2015 Blaz Orazem

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
</pre>