<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 07.06.2020
 */

namespace App\Common\CQRS\Middlewares;

use App\Common\CQRS\CommandInterface;
use App\Common\CQRS\QueryInterface;
use App\Common\Validation\Exceptions\ValidationException;
use App\Common\Validation\Validator;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

/**
 * Class ValidateCommandMiddleware
 *
 * @package App\Common\Messenger\Middlewares
 */
class ValidateCommandMiddleware implements MiddlewareInterface
{
    /**
     * @var Validator
     */
    protected Validator $validator;

    /**
     * ValidateCommandMiddleware constructor.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Envelope $envelope
     * @param StackInterface $stack
     *
     * @return Envelope
     *
     * @throws ValidationException
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $message = $envelope->getMessage();

        if ($message instanceof CommandInterface || $message instanceof QueryInterface) {
            $this->validator->validate($message);
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
