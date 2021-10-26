<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Assert;

/**
 * Class Assertion
 *
 * @package Dnhb\ApiClient\Import\Assert
 */
final class Assertion extends \Assert\Assertion
{
    /** */
    const INVALID_POSTALCODE = 301;

    /** */
    const INVALID_PHONENUMBER = 302;

    /**
     * Assert that value is a postal code.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function postalcode($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (0 === preg_match('/^[1-9]{1}\d{3}[A-Z]{2}$/', $value)) {
            $message = sprintf(
                static::generateMessage($message) ?: 'Postal code should be of valid format (1000AA), got "%s"',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_POSTALCODE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a phonenumber.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function phonenumber($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        $pattern = '/^\+?[\d\-\s]+$/';
        if (0 === preg_match($pattern, $value)) {
            $message = sprintf(
                static::generateMessage($message) ?: 'Value "%s" was expected to be a valid phonenumber.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_PHONENUMBER, $propertyPath);
        }

        return true;
    }
}
