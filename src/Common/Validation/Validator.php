<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Validation;

use App\Common\Validation\Exceptions\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Validator
 *
 * @package App\Common\Validation
 */
class Validator
{
    /**
     * @var ValidatorInterface
     */
    protected ValidatorInterface $validator;

    /**
     * Validator constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $data
     * @param array|null $groups
     *
     * @return void
     *
     * @throws ValidationException
     */
    public function validate($data, ?array $groups = null): void
    {
        $errors = $this->validator->validate($data, null, $groups);

        if ($errors->count()) {
            throw new ValidationException($errors);
        }
    }
}
