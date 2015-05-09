<?php namespace BlazOrazem;

use PHPUnit_Framework_TestCase;

class SanitizerTest extends PHPUnit_Framework_TestCase {

    public function testSanitizerNameString()
    {
        $name = Sanitizer::name('mr. chuck norris');
        $result = 'Mr. Chuck Norris';
        $this->assertEquals($result, $name);
    }

    public function testSanitizerEmailString()
    {
        $email = Sanitizer::email('CHUCK@norris.COM');
        $result = 'chuck@norris.com';
        $this->assertEquals($result, $email);

        $email = Sanitizer::email('CHUCK @norris?.COM');
        $result = null;
        $this->assertEquals($result, $email);

        $email = Sanitizer::email('CHUCK @norris?.COM', 'This is not a valid e-mail address!');
        $result = null;
        $this->assertEquals($result, $email);
    }

    public function testSanitizerUrlString()
    {
        $url = Sanitizer::url('this Shőüld be \n sąn`itiz˘ed /// web-safe STRING/ with € cú˘rrenc~y at THE...END');
        $result = 'this-should-be-sanitized-web-safe-string/-with-eur-currency-at-the.end';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url('Ŵĥăţ ĩş ŷōuř ñąmĕ? Mý ŉǎmę ĭŝ Ĉħǚçķ Ñöŕŗǐś.');
        $result = 'what-is-your-name-my-name-is-chuck-norris';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url('Как вас зовут? Меня зовут Чхучк Норрис.');
        $result = 'kak-vas-zovut-mena-zovut-chuck-norris';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url('Fußgängerübergänge, Größenmaßstäbe, Größenordnungsmäßig');
        $result = 'fussgangerubergange-grossenmassstabe-grossenordnungsmassig';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url('I have 100 € & 50 $ & 25 RD$');
        $result = 'i-have-100-eur-50-usd-25-dop';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url('THERE WILL BE NO CAPS HERE!');
        $result = 'there-will-be-no-caps-here';
        $this->assertEquals($result, $url);

        $url = Sanitizer::url("I'm the Sanitizer class & I will convert your string 100%!");
        $result = 'im-the-sanitizer-class-i-will-convert-your-string-100';
        $this->assertEquals($result, $url);
    }

    public function testSanitizeUrlCurrency()
    {
        $currencyString = 'lekallbobbgn-kzt-kgsbrlkhrcny-jpycrccup-phpdopgbpeurghcirr-omr-qar-sar-yerilsjmdkpw-krwlakmkdmntniongnplnrubrsdtwdthbttduahuyuvndzwdusd';
        $currencies = array('؋'=>'lek','bz$'=>'all','$b'=>'bob','лв'=>'bgn-kzt-kgs','r$'=>'brl',
            '៛'=>'khr','¥'=>'cny-jpy','₡'=>'crc','₱'=>'cup-php','rd$'=>'dop','£'=>'gbp','€'=>'eur','¢'=>'ghc',
            '﷼'=>'irr-omr-qar-sar-yer','₪'=>'ils','j$'=>'jmd','₩'=>'kpw-krw','₭'=>'lak','ден'=>'mkd','₮'=>'mnt',
            'c$'=>'nio','₦'=>'ngn','zł'=>'pln','руб'=>'rub','Дин.'=>'rsd','nt$'=>'twd','฿'=>'thb','tt$'=>'ttd',
            '₴'=>'uah','$u'=>'uyu','₫'=>'vnd','z$'=>'zwd','$'=>'usd');
        $result = '';
        foreach ($currencies as $currency) {
            $result .= Sanitizer::url($currency);
        }
        $this->assertEquals($result, $currencyString);
    }

}
