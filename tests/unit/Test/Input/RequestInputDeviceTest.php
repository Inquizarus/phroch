<?php
namespace Botty\Test\Input;

use Botty\Command\MoveForwardCommand;
use Botty\Input\BasicInputDevice;
use Botty\Input\InputDeviceInterface;
use Botty\Robot\BasicRobot;
use Botty\Robot\RobotInterface;
use PHPUnit\Framework\TestCase;

class RequestInputDeviceTest extends TestCase
{
    /**
     * @test
     */
    public function testItCanAttachRobot()
    {
        $device = new BasicInputDevice();
        $robot = $this->getMockBuilder(RobotInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $this->assertInstanceOf(InputDeviceInterface::class, $device->attachRobot($robot));
    }

    /**
     * @test
     */
    public function testItReturnsTrueWhenCommandIsSuccessfullyRun()
    {
        $device = new BasicInputDevice();
        $robot = $this->getMockBuilder(RobotInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $device->attachRobot($robot);

        $result = $device->runCommand(new MoveForwardCommand());

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function testItReturnsTrueWhenShortCutsAreUsed()
    {
        $device = new BasicInputDevice();
        $robot = $this->getMockBuilder(RobotInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $device->attachRobot($robot);

        $this->assertTrue($device->forward());
        $this->assertTrue($device->backwards());
        $this->assertTrue($device->left());
        $this->assertTrue($device->right());
    }
}