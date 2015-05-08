<?php namespace BlazOrazem;

/**
 * Sanitizer is a package for sanitizing URLs, names, email addresses etc.
 *
 * @package    Sanitizer
 * @author     Blaz Orazem <blaz@orazem.info>
 * @copyright  Copyright (c) 2015 Blaz Orazem (http://www.numencode.com)
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.1.0
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
        return trim(ucwords(mb_strtolower(trim($string), 'utf-8')));
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
        $email = trim(mb_strtolower(trim($email), 'utf-8'));

        // Validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $errorMsg ?: 'Invalid e-mail address.';
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

        // Replace accented characters with corresponding unaccented characters
        $search	= array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',
            'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë',
            'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą',
            'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě',
            'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı',
            'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ',
            'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š',
            'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ',
            'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ',
            'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N',
            'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a',
            'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'DZ', 'dz', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e',
            'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i',
            'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n',
            'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's',
            'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y',
            'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o',
            'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        $string = str_replace($search, $replace, $string);

        // Replace Cyrillic script characters with corresponding Latin script characters
        $search = array('А','Ӑ','Ӓ','Ә','Ӛ','Ӕ','Б','В','Г','Ґ','Ѓ','Ғ','Ӷ','Ҕ','Д','Ђ','Е','Ѐ','Ё','Ӗ','Ҽ','Ҿ','Є',
            'Ж','Ӂ','Җ','Ӝ','З','Ҙ','Ӟ','Ӡ','Ѕ','И','Ѝ','Ӥ','Ӣ','І','Ї','Ӏ','Й','Ҋ','Ј','К','Қ','Ҟ','Ҡ','Ӄ','Ҝ','Л','Ӆ','Љ',
            'М','Ӎ','Н','Ӊ','Ң','Ӈ','Ҥ','Њ','О','Ӧ','Ө','Ӫ','Ҩ','П','Ҧ','Р','Ҏ','С','Ҫ','Т','Ҭ','Ћ','Ќ','У','Ў','Ӳ','Ӱ','Ӯ','Ү','Ұ',
            'Ф','Х','Ҳ','Һ','Ц','Ҵ','Ч','Ӵ','Ҷ','Ӌ','Ҹ','Џ','Ш','Щ','Ъ','Ы','Ӹ','Ь','Ҍ','Э','Ӭ','Ю','Я','а','ӑ','ӓ','ә','ӛ','ӕ','б','в',
            'г','ґ','ѓ','ғ','ӷ','ҕ','д','ђ','е','ѐ','ё','ӗ','ҽ','ҿ','є','ж','ӂ','җ','ӝ','з','ҙ','ӟ','ӡ','ѕ','и','ѝ','ӥ','ӣ','і','ї','Ӏ',
            'й','ҋ','ј','к','қ','ҟ','ҡ','ӄ','ҝ','л','ӆ','љ','м','ӎ','н','ӊ','ң','ӈ','ҥ','њ','о','ӧ','ө','ӫ','ҩ','п','ҧ','р','ҏ','с','ҫ',
            'т','ҭ','ћ','ќ','у','ў','ӳ','ӱ','ӯ','ү','ұ','ф','х','ҳ','һ','ц','ҵ','ч','ӵ','ҷ','ӌ','ҹ','џ','ш','щ','ъ','ы','ӹ','ь','ҍ','э','ӭ','ю','я');
        $replace = array('A','A','A','E','E','AE','B','V','G','G','G','G','G','G','D','D','E','E','E','E','E','E','E',
            'Z','Z','Z','Z','Z','Z','Z','DZ','DZ','I','I','I','I','I','I','I','J','J','J','K','K','K','K','K','K','L','L','LJ',
            'M','M','N','H','H','H','EH','NJ','O','O','O','O','O','P','PE','R','R','S','S','T','T','C','V','U','U','U','U','U','Y','Y',
            'F','H','X','H','C','C','C','C','Y','Y','Y','DZ','S','S','Y','Y','Y','Y','Y','E','E','U','a','a','a','a','e','e','ae','b','v',
            'g','g','g','g','g','g','d','d','e','e','e','e','e','e','e','z','z','z','z','z','z','z','dz','dz','i','i','i','i','i','i','i',
            'j','j','j','k','k','k','k','k','k','l','l','lj','m','m','n','h','h','h','eh','nj','o','o','o','o','o','p','pe','r','r','s','s',
            't','t','c','k','u','u','u','u','u','y','y','f','h','x','h','c','c','c','c','y','y','y','dz','s','s','y','y','y','y','y','e','e','u','a');
        $string = str_replace($search, $replace, $string);

        // Replace currency symbols
        $search = array('£', '$', '€', '¥');
        $replace = array('gbp', 'usd', 'eur', 'yen');
        $string= str_replace($search, $replace, $string);

        // Replace other reserved and unsafe characters
        $search = array(' ', '%20', '&nbsp;', '&', '+', ',', '//', ' /', '\r\n', '\n');
        $string = str_replace($search, '-', $string);

        // Replace other reserved, unsafe and special characters with RegEx
        $char_regex1 = '/[^a-z0-9\-.\/]/';	// Any character except: 'a' to 'z', '0' to '9', '\-', '.', '/'
        $char_regex2 = '/[\-]+/';		    // Any character of: '\-' (1 or more times (matching the most amount possible))
        $char_regex3 = '/<[^>]*>/';		    // Any character except: '>' (0 or more times (matching the most amount possible))
        $char_regex4 = '/\.{2,}/';		    // '.' at least 2 times (matching the most amount possible)
        $search = array($char_regex1, $char_regex2, $char_regex3, $char_regex4);
        $replace = array('', '-', '', '.');
        $string = preg_replace($search, $replace, $string);

        // Trim and return sanitized URL string
        return trim($string);
    }

}
