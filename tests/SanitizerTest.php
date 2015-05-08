<?php namespace BlazOrazem;

use PHPUnit_Framework_TestCase;

class SanitizerTest extends PHPUnit_Framework_TestCase {

    public function testSanitizerName()
    {
        $name = Sanitizer::name('mr. chuck norris');
        $result = 'Mr. Chuck Norris';
        $this->assertEquals($result, $name);
    }

    public function testSanitizerEmail()
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

    public function testSanitizerUrl()
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
    }

}
