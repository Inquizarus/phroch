<?php
namespace Botty\Controller;

use Botty\Logger;
use Botty\GridInterface;
use Botty\Input\InputDeviceInterface;
use \Symfony\Component\HttpFoundation\{Request, Response};
use Botty\Factory\{AcmeFactory, CommandFactory, ObstacleFactory};

class IndexController
{
        /** @var array  */
        private $data = [
            "message" => "",
            "data" => []
        ];

    /**
     * @param Request $request
     *
     * @return Response
     **/
    public function getIndex(Request $request): Response
    {
        $logger = new Logger();
        $acmeFactory = new AcmeFactory($logger);
        $grid       = $acmeFactory->makeGridFromRequest($request);
        $satellite  = $acmeFactory->makeSatelliteWithGrid($grid);
        $uplink     = $acmeFactory->makeUplinkWithSatellite($satellite);
        $navigator  = $acmeFactory->makeNavigatorFromRequest($request);
        $robot      = $acmeFactory->makeRobotWithComponents($navigator, $uplink);
        $inputDevice = $acmeFactory->makeInputDeviceWithRobot($robot);

        $grid->addRobot($robot);

        $this->addObstaclesToGrid($request, $grid);

        $this->data['data']['grid'] = $this->buildGridResponseData($grid);
        $this->data['data']['robot'] = [
            'start_x' => $navigator->getCurrentPositionX(),
            'start_y' => $navigator->getCurrentPositionY()
        ];

        $this->playWithRequest($request, $inputDevice);

        $this->data['data']['logs'] = [];
        foreach ($logger->getLogEntries() AS $entry) {
            $this->data['data']['logs'][] = (string) $entry;
        }

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
        $commandFactory = new CommandFactory();
        $commands = $commandFactory->makeCommandsFromRequest($request);
        $inputDevice->runCommands($commands);
    }

    /**
     * @param Request       $request
     * @param GridInterface $grid
     */
    private function addObstaclesToGrid(Request $request, $grid): void
    {
        $obstacleFactory = new ObstacleFactory();
        $obstacles = $obstacleFactory->makeObstaclesFromRequest($request);
        foreach ($obstacles AS $obstacle) {
            $grid->addObstacle($obstacle);
        }
    }
}
