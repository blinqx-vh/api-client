<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Data;


use MyCLabs\Enum\Enum;

/**
 * Class ClientStatus
 *
 * @package Dnhb\ApiClient\Data
 */
final class ClientStatus extends Enum
{
    /** */
    const ACTIVE = 'G';
    /** */
    const PROCESSING = 'I';
    /** */
    const REJECTED = 'A';
    /** */
    const EXPIRED = 'V';
    /** */
    const UNKNOWN = 'O';
    /** */
    const LEAD = 'L';
    /** */
    const PROSPECT = 'P';
    /** */
    const DONE = 'X';
    /** */
    const WAITING_FOR_NOTARY = 'Z';
    /** */
    const PAPERS_TO_NOTARY = 'N';
    /** */
    const REDEEMED = 'T';
}