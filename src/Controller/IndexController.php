<?php
namespace Botty\Controller;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class IndexController
{
        /**
         * @param Request $request
         *
         * @return Response
         **/
        public function getIndex(Request $request): Response
        {
                $response = new Response(\json_encode([]), 200, [
                        'Content-Type' => 'application/json'
                ]);
                return $response;
        }
}
