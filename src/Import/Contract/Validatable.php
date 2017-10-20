<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Contract;

use Dnhb\ApiClient\Import\Manager\ValidationManager;

/**
 * Interface Validatable
 *
 * @package Dnhb\ApiClient\Import\Contract
 */
interface Validatable
{
    /**
     * @param ValidationManager $validationManager
     */
    public function validate(ValidationManager $validationManager);
}