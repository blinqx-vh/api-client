<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class FieldType
 */
final class FieldType extends Enum
{
    /**  */
    const FIELD_STREET = 'street';

    /**  */
    const FIELD_HOUSE_NUMBER = 'housenumber';

    /**  */
    const FIELD_CITY = 'city';

    /**  */
    const FIELD_POSTALCODE = 'postalcode';

    /**  */
    const FIELD_HOUSE_NUMBER_ADDITION = 'housenumber-addition';

    /**  */
    const FIELD_MUNICIPALITY = 'municipality';
}