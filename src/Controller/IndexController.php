<?php
namespace Botty\Controller;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class IndexController
{

        public function getIndex(Request $request)
        {
                $response = new Response(\json_encode([]), 200, [
                    'Content-Type' => 'application/json'
                ]);
                return $response;
        }
}
