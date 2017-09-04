<?php
namespace Botty\Controller;

use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Factory\AcmeFactory;
use Botty\Factory\AcmeFactoryInterface;
use Botty\GridInterface;
use Botty\Input\InputDeviceInterface;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class IndexController
{
        /** @var array  */
        private $data = [
            "message" => "",
            "data" => []
        ];

        /** @var AcmeFactoryInterface */
        private $AcmeFactory = null;

    /**
     * @return AcmeFactoryInterface
     */
    public function getAcmeFactory(): AcmeFactoryInterface
    {
        if (empty($this->AcmeFactory)) {
            $this->AcmeFactory = new AcmeFactory();
        }
        return $this->AcmeFactory;
    }

    /**
     * @param AcmeFactoryInterface $AcmeFactory
     */
    public function setAcmeFactory(AcmeFactoryInterface $AcmeFactory)
    {
        $this->AcmeFactory = $AcmeFactory;
    }

        /**
         * @param Request $request
         *
         * @return Response
         **/
        public function getIndex(Request $request): Response
        {

            $grid = $this->getAcmeFactory()->makeGridFromRequest($request);
            $satellite = $this->getAcmeFactory()->makeSatelliteWithGrid($grid);
            $uplink = $this->getAcmeFactory()->makeUplinkWithSatellite($satellite);
            $navigator = $this->getAcmeFactory()->makeNavigatorFromRequest($request);
            $robot = $this->getAcmeFactory()->makeRobotWithComponents($navigator, $uplink);
            $inputDevice = $this->getAcmeFactory()->makeInputDeviceWithRobot($robot);
            $grid->addRobot($robot);

            $this->playWithRequest($request, $inputDevice);

            $this->data['data']['grid'] = $this->buildGridResponseData($grid);

            $response = new Response(\json_encode($this->data), 200, [
                    'Content-Type' => 'application/json'
            ]);
            return $response;
        }

    /**
     * @param GridInterface $grid
     * @return array
     */
    private function buildGridResponseData(GridInterface $grid): array
    {
        return [
            'width'     => $grid->getSizeX(),
            'height'    => $grid->getSizeY(),
            'robots'    => count($grid->getRobots()),
            'obstacles' => count($grid->getObstacles())
        ];
    }

    /**
     * @param Request $request
     *
     * @param InputDeviceInterface $inputDevice
     */
    private function playWithRequest(Request $request,InputDeviceInterface $inputDevice): void
    {
        $stringCommands = $request->query->has('commands') ? $request->query->get('commands') : '';
        for ($x=0;$x<strlen($stringCommands);$x++) {
            switch ($stringCommands[$x]) {
                case 'l':
                    $inputDevice->left();
                    break;
                case 'r':
                    $inputDevice->right();
                    break;
                case 'f':
                    $inputDevice->forward();
                    break;
                case 'b':
                    $inputDevice->backwards();
                    break;
            }
        }

    }
}
