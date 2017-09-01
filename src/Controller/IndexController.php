<?php
namespace Botty\Controller;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class IndexController
{
        /** @var array  */
        private $data = [
            "message" => "",
        ];

        /**
         * @param Request $request
         *
         * @return Response
         **/
        public function getIndex(Request $request): Response
        {
                $response = new Response(\json_encode($this->data), 200, [
                        'Content-Type' => 'application/json'
                ]);
                return $response;
        }
}
