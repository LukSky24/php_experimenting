<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 08.05.2020
 */

namespace App\Common\Http\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BadJsonRequestException
 *
 * @package App\Common\Http\Exceptions
 */
class BadJsonRequestException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $messageKey = 'common.http.bad_json_request_exception';

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * BadJsonRequestException constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct('Bad JSON request: "' . $request->getContent() . '"');

        $this->request = $request;
    }
}
