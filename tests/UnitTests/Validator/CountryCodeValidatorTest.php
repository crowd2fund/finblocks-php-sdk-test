<?php

namespace FinBlocks\Tests\UnitTests\Validator;

use FinBlocks\Validator\CountryCodeValidator;
use PHPUnit\Framework\TestCase;

class CountryCodeValidatorTest extends TestCase
{
    public function testValidationOfNullCountryCode()
    {
        $valid = CountryCodeValidator::nullOrValidate(null);

        $this->assertNull($valid);
    }

    public function testValidationOfValidCountryCode()
    {
        $valid = CountryCodeValidator::nullOrValidate('GBR');

        $this->assertNull($valid);
    }

    public function testValidationOfInvalidCountryCode()
    {
        $this->expectException(\InvalidArgumentException::class);

        CountryCodeValidator::nullOrValidate('AAA');
    }
}
