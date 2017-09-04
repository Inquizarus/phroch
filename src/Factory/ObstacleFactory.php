<?php
namespace Botty\Factory;

use Botty\Obstacle\BasicObstacle;
use Symfony\Component\HttpFoundation\Request;

class ObstacleFactory implements ObstacleFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function makeObstaclesFromRequest(Request $request): array
    {
        $obstacles = [];
        $obstaclesString = $request->query->get('obstacles');

        if ($obstaclesString) {
            $obstacleCoordinates = explode('-', $obstaclesString);
            foreach ($obstacleCoordinates AS $obstacleCoordinate) {
                $coordinates = explode(',', $obstacleCoordinate);
                if (count($coordinates) === 2) {
                    $obstacles[] = new BasicObstacle($coordinates[0], $coordinates[1]);
                }
            }
        }

        return $obstacles;
    }

}