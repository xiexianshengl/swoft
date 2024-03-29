<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Log\Debug;
use Swoft\Rpc\Error;
use Swoft\Rpc\Server\Exception\Handler\RpcErrorHandler;
use Swoft\Rpc\Server\Response;
use Swoft\Validator\Exception\ValidatorException;
use Throwable;

/**
 * Class RpcExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler(\Throwable::class)
 */
class RpcExceptionHandler extends RpcErrorHandler
{
    /**
     * @param Throwable $e
     * @param Response  $response
     *
     * @return Response
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function handle(Throwable $e, Response $response): Response
    {
        if ($e instanceof ValidatorException){
            $error = Error::new($e->getCode(), $e->getMessage(), null);
            $response->setError($error);
        }else{
            // Debug is false
            if (!APP_DEBUG) {
                $message = sprintf(' %s At %s line %d', $e->getMessage(), $e->getFile(), $e->getLine());
                $error   = Error::new($e->getCode(), $message, null);
            } else {
                $error = Error::new($e->getCode(), $e->getMessage(), null);
            }

            Debug::log('Rpc server error(%s)', $e->getMessage());

            $response->setError($error);
        }

        // Debug is true
        return $response;


    }
}
