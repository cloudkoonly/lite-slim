<?php

namespace Liteslim;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Liteslim\Library\Utility;

class Test extends Base
{
    /**
     * @throws Exception
     */
    public function registerUser(Request $request, Response $response): Response {

        $this->logger->info("User registered successfully");
        $message = 'Hello test, ' . Utility::test() . ', ' . Utility::ENV_DEV;
        return $this->respondWithJson($response, 200, $message, []);
    }
}