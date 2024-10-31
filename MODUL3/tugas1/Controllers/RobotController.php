<?php
namespace Controllers;

use Models\Robot;
use Models\RobotTempur;

class RobotController {
    private $currentRobot; 

    public function tampilkanRobotBiasa() {
        if ($this->currentRobot === null || !$this->currentRobot instanceof Robot) {
            $this->currentRobot = new Robot("Android-X", 2025, "Putih", 60);
        }
        echo $this->currentRobot;
        return $this->currentRobot;
    }

    public function tampilkanRobotTempur() {
        if ($this->currentRobot === null || !$this->currentRobot instanceof RobotTempur) {
            $this->currentRobot = new RobotTempur("T-800", 2029, "Hitam", 100, true);
        }
        echo $this->currentRobot;
        return $this->currentRobot;
    }
}
?>
