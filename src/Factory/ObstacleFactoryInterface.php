<?php
namespace Botty\Factory;

use Botty\Obstacle\ObstacleInterface;
use Symfony\Component\HttpFoundation\Request;

interface ObstacleFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return ObstacleInterface[]
     */
    public function makeObstaclesFromRequest(Request $request): array;
}