<?php namespace BlazOrazem;

/**
 * Sanitizer is a package convenient for sanitizing proper names, email addresses, URLs etc.
 *
 * @package    Sanitizer
 * @author     Blaz Orazem <blaz@orazem.info>
 * @copyright  Copyright (c) 2015 Blaz Orazem (http://www.numencode.com)
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.2.1
 * @link       https://github.com/BlazOrazem/sanitizer
 * @since      1.0.0
 */
class Sanitizer {

    /**
     * Returns CamelCased string.
     *
     * @param null|string $string User's input string.
     * @return null|string
     */
    public static function name($string = null)
    {
        if (!$string) return null;

        // Convert to lowercase, set UTF-8 character encoding, trim and return CamelCased string
        return trim(ucwords(mb_strtolower(trim($string), "UTF-8")));
    }

    /**
     * Validates and returns sanitized email address.
     *
     * @param null|string $email User's input email address.
     * @param null|string $errorMsg Optional user's error message for invalid email address.
     * @return string
     */
    public static function email($email = null, $errorMsg = null)
    {
        if (!$email) return null;

        // Convert to lowercase and set UTF-8 character encoding
        $email = trim(mb_strtolower(trim($email), "UTF-8"));

        // Validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }
        // Return email address
        return $email;
    }

    /**
     * Convenient when encoding a string to be used in a query part of an URL.
     * Removes or replaces with corresponding web-safe characters all reserved and unsafe characters.
     * Replaces Cyrillic script alphabet characters with corresponding Latin script alphabet characters.
     *
     * @param null|string $string User's input string.
     * @return null|string
     */
    public static function url($string = null)
    {
        if (!$string) return null;

        // Convert to lower-case and convert internal character encoding to UTF-8
        $string = mb_strtolower(trim($string), "UTF-8");

        // Replace currency symbols
        $string = strtr($string, array('؋'=>'lek','bz$'=>'all','$b'=>'bob','лв'=>'bgn-kzt-kgs','r$'=>'brl',
            '៛'=>'khr','¥'=>'cny-jpy','₡'=>'crc','₱'=>'cup-php','rd$'=>'dop','£'=>'gbp','€'=>'eur','¢'=>'ghc',
            '﷼'=>'irr-omr-qar-sar-yer','₪'=>'ils','j$'=>'jmd','₩'=>'kpw-krw','₭'=>'lak','ден'=>'mkd','₮'=>'mnt',
            'c$'=>'nio','₦'=>'ngn','zł'=>'pln','руб'=>'rub','Дин.'=>'rsd','nt$'=>'twd','฿'=>'thb','tt$'=>'ttd',
            '₴'=>'uah','$u'=>'uyu','₫'=>'vnd','z$'=>'zwd','$'=>'usd'));

        // Replace accented characters with corresponding unaccented characters
        $string = strtr($string, array('À'=>'A','Á'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','Å'=>'A','Æ'=>'AE','Ç'=>'C',
            'È'=>'E','É'=>'E','Ê'=>'E','Ë'=>'E','Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I','Ð'=>'D','Ñ'=>'N','Ò'=>'O',
            'Ó'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','Ø'=>'O','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','ß'=>'ss',
            'à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','å'=>'a','æ'=>'ae','ç'=>'c','è'=>'e','é'=>'e','ê'=>'e',
            'ë'=>'e','ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o',
            'ø'=>'o','ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y','Ā'=>'A','ā'=>'a','Ă'=>'A','ă'=>'a',
            'Ą'=>'A','ą'=>'a','Ć'=>'C','ć'=>'c','Ĉ'=>'C','ĉ'=>'c','Ċ'=>'C','ċ'=>'c','Č'=>'C','č'=>'c','Ď'=>'D',
            'ď'=>'d','Đ'=>'DZ','đ'=>'dz','Ē'=>'E','ē'=>'e','Ĕ'=>'E','ĕ'=>'e','Ė'=>'E','ė'=>'e','Ę'=>'E','ę'=>'e',
            'Ě'=>'E','ě'=>'e','Ĝ'=>'G','ĝ'=>'g','Ğ'=>'G','ğ'=>'g','Ġ'=>'G','ġ'=>'g','Ģ'=>'G','ģ'=>'g','Ĥ'=>'H',
            'ĥ'=>'h','Ħ'=>'H','ħ'=>'h','Ĩ'=>'I','ĩ'=>'i','Ī'=>'I','ī'=>'i','Ĭ'=>'I','ĭ'=>'i','Į'=>'I','į'=>'i',
            'İ'=>'I','ı'=>'i','Ĳ'=>'IJ','ĳ'=>'ij','Ĵ'=>'J','ĵ'=>'j','Ķ'=>'K','ķ'=>'k','Ĺ'=>'L','ĺ'=>'l','Ļ'=>'L',
            'ļ'=>'l','Ľ'=>'L','ľ'=>'l','Ŀ'=>'L','ŀ'=>'l','Ł'=>'l','ł'=>'l','Ń'=>'N','ń'=>'n','Ņ'=>'N','ņ'=>'n',
            'Ň'=>'N','ň'=>'n','ŉ'=>'n','Ō'=>'O','ō'=>'o','Ŏ'=>'O','ŏ'=>'o','Ő'=>'O','ő'=>'o','Œ'=>'OE','œ'=>'oe',
            'Ŕ'=>'R','ŕ'=>'r','Ŗ'=>'R','ŗ'=>'r','Ř'=>'R','ř'=>'r','Ś'=>'S','ś'=>'s','Ŝ'=>'S','ŝ'=>'s','Ş'=>'S',
            'ş'=>'s','Š'=>'S','š'=>'s','Ţ'=>'T','ţ'=>'t','Ť'=>'T','ť'=>'t','Ŧ'=>'T','ŧ'=>'t','Ũ'=>'U','ũ'=>'u',
            'Ū'=>'U','ū'=>'u','Ŭ'=>'U','ŭ'=>'u','Ů'=>'U','ů'=>'u','Ű'=>'U','ű'=>'u','Ų'=>'U','ų'=>'u','Ŵ'=>'W',
            'ŵ'=>'w','Ŷ'=>'Y','ŷ'=>'y','Ÿ'=>'Y','Ź'=>'Z','ź'=>'z','Ż'=>'Z','ż'=>'z','Ž'=>'Z','ž'=>'z','ſ'=>'s',
            'ƒ'=>'f','Ơ'=>'O','ơ'=>'o','Ư'=>'U','ư'=>'u','Ǎ'=>'A','ǎ'=>'a','Ǐ'=>'I','ǐ'=>'i','Ǒ'=>'O','ǒ'=>'o',
            'Ǔ'=>'U','ǔ'=>'u','Ǖ'=>'U','ǖ'=>'u','Ǘ'=>'U','ǘ'=>'u','Ǚ'=>'U','ǚ'=>'u','Ǜ'=>'U','ǜ'=>'u','Ǻ'=>'A',
            'ǻ'=>'a','Ǽ'=>'AE','ǽ'=>'ae','Ǿ'=>'O','ǿ'=>'o'));

        // Replace Cyrillic script characters with corresponding Latin script characters
        $string = strtr($string, array('А'=>'A','Ӑ'=>'A','Ӓ'=>'A','Ә'=>'E','Ӛ'=>'E','Ӕ'=>'AE','Б'=>'B','В'=>'V',
            'Г'=>'G','Ґ'=>'G','Ѓ'=>'G','Ғ'=>'G','Ӷ'=>'G','Ҕ'=>'G','Д'=>'D','Ђ'=>'D','Е'=>'E','Ѐ'=>'E','Ё'=>'E',
            'Ӗ'=>'E','Ҽ'=>'E','Ҿ'=>'E','Є'=>'E','Ж'=>'Z','Ӂ'=>'Z','Җ'=>'Z','Ӝ'=>'Z','З'=>'Z','Ҙ'=>'Z','Ӟ'=>'Z',
            'Ӡ'=>'DZ','Ѕ'=>'DZ','И'=>'I','Ѝ'=>'I','Ӥ'=>'I','Ӣ'=>'I','І'=>'I','Ї'=>'I','Ӏ'=>'I','Й'=>'J','Ҋ'=>'J',
            'Ј'=>'J','К'=>'K','Қ'=>'K','Ҟ'=>'K','Ҡ'=>'K','Ӄ'=>'K','Ҝ'=>'K','Л'=>'L','Ӆ'=>'L','Љ'=>'LJ','М'=>'M',
            'Ӎ'=>'M','Н'=>'N','Ӊ'=>'H','Ң'=>'H','Ӈ'=>'H','Ҥ'=>'EH','Њ'=>'NJ','О'=>'O','Ӧ'=>'O','Ө'=>'O','Ӫ'=>'O',
            'Ҩ'=>'O','П'=>'P','Ҧ'=>'PE','Р'=>'R','Ҏ'=>'R','С'=>'S','Ҫ'=>'S','Т'=>'T','Ҭ'=>'T','Ћ'=>'C','Ќ'=>'V',
            'У'=>'U','Ў'=>'U','Ӳ'=>'U','Ӱ'=>'U','Ӯ'=>'U','Ү'=>'Y','Ұ'=>'Y','Ф'=>'F','Х'=>'H','Ҳ'=>'X','Һ'=>'H',
            'Ц'=>'C','Ҵ'=>'C','Ч'=>'C','Ӵ'=>'C','Ҷ'=>'Y','Ӌ'=>'Y','Ҹ'=>'Y','Џ'=>'DZ','Ш'=>'S','Щ'=>'S','Ъ'=>'Y',
            'Ы'=>'Y','Ӹ'=>'Y','Ь'=>'Y','Ҍ'=>'Y','Э'=>'E','Ӭ'=>'E','Ю'=>'U','Я'=>'a','а'=>'a','ӑ'=>'a','ӓ'=>'a',
            'ә'=>'e','ӛ'=>'e','ӕ'=>'ae','б'=>'b','в'=>'v','г'=>'g','ґ'=>'g','ѓ'=>'g','ғ'=>'g','ӷ'=>'g','ҕ'=>'g',
            'д'=>'d','ђ'=>'d','е'=>'e','ѐ'=>'e','ё'=>'e','ӗ'=>'e','ҽ'=>'e','ҿ'=>'e','є'=>'e','ж'=>'z','ӂ'=>'z',
            'җ'=>'z','ӝ'=>'z','з'=>'z','ҙ'=>'z','ӟ'=>'z','ӡ'=>'dz','ѕ'=>'dz','и'=>'i','ѝ'=>'i','ӥ'=>'i','ӣ'=>'i',
            'і'=>'i','ї'=>'i','й'=>'j','ҋ'=>'j','ј'=>'j','к'=>'k','қ'=>'k','ҟ'=>'k','ҡ'=>'k','ӄ'=>'k','ҝ'=>'k',
            'л'=>'l','ӆ'=>'l','љ'=>'lj','м'=>'m','ӎ'=>'m','н'=>'n','ӊ'=>'h','ң'=>'h','ӈ'=>'h','ҥ'=>'eh','њ'=>'nj',
            'о'=>'o','ӧ'=>'o','ө'=>'o','ӫ'=>'o','ҩ'=>'o','п'=>'p','ҧ'=>'pe','р'=>'r','ҏ'=>'r','с'=>'s','ҫ'=>'s',
            'т'=>'t','ҭ'=>'t','ћ'=>'c','ќ'=>'k','у'=>'u','ў'=>'u','ӳ'=>'u','ӱ'=>'u','ӯ'=>'u','ү'=>'y','ұ'=>'y',
            'ф'=>'f','х'=>'h','ҳ'=>'x','һ'=>'h','ц'=>'c','ҵ'=>'c','ч'=>'c','ӵ'=>'c','ҷ'=>'y','ӌ'=>'y','ҹ'=>'y',
            'џ'=>'dz','ш'=>'s','щ'=>'s','ъ'=>'y','ы'=>'y','ӹ'=>'y','ь'=>'y','ҍ'=>'y','э'=>'e','ӭ'=>'e','ю'=>'u',
            'я'=>'a'));

        // Replace other reserved and unsafe characters
        $string = strtr($string, array(' '=>'-','%20'=>'-','&nbsp;'=>'-','&'=>'-','+'=>'-',','=>'-','//'=>'-',
            ' /'=>'-','\r\n'=>'-','\n'=>'-','-/-'=>'/'));

        // Replace other reserved, unsafe and special characters with RegEx
        $char_regex1 = '/[^a-z0-9\-.\/]/';	// Any character except: 'a' to 'z', '0' to '9', '\-', '.', '/'
        $char_regex2 = '/[\-]+/';		    // Any character of: '\-' (1 or more times (matching the most amount possible))
        $char_regex3 = '/<[^>]*>/';		    // Any character except: '>' (0 or more times (matching the most amount possible))
        $char_regex4 = '/\.{2,}/';		    // '.' at least 2 times (matching the most amount possible)
        $search = array($char_regex1, $char_regex2, $char_regex3, $char_regex4);
        $replace = array('', '-', '', '.');
        $string = preg_replace($search, $replace, $string);

        // Remove slash/dot at the beginning/end of the string
        $string = strtr($string, array('-/-'=>'/'));
        $string = ltrim($string, '/');
        $string = rtrim($string, '/');
        $string = ltrim($string, '.');
        $string = rtrim($string, '.');

        // Trim and return sanitized URL string
        return trim($string);
    }

}
