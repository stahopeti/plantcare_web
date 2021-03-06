<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use app\models\Pots;
use app\models\SensorData;

/**
 * Description of DashboardPotData
 *
 * @author Stahorszki Péter
 */
class DashboardPotData {
    //put your code here
    private $pot;
    private $lastSensorData;
    
    function __construct($potId) {
        $this->pot = Pots::findIdentity($potId);
        $this->lastSensorData = SensorData::findByPotIdLastEntry($this->pot->getId());
        if($this->lastSensorData === null){
            $this->lastSensorData = new SensorData();
            $this->lastSensorData->timestamp = 'N\A';
            $this->lastSensorData->light = 'N\A';
            $this->lastSensorData->moisture= 'N\A';
            $this->lastSensorData->temperature = 'N\A';
            $this->lastSensorData->lamp_on = 'N\A';
            $this->lastSensorData->watertank_empty = 'N\A';
        }
    }

    function getPotId() {
        return $pot->getId();
    }

    function getPotName() {
        return $this->pot->getName();
    }

    function getTimestamp() {
        return $this->lastSensorData->getTimeStamp();
    }

    function getLight() {
        return $this->lastSensorData->getLight();
    }

    function getMoisture() {
        return $this->lastSensorData->getMoisture();
    }

    function getTemperature() {
        return $this->lastSensorData->getTemperature();
    }

    function getLightOn() {
        return $this->lastSensorData->getLightOn();
    }

    function getWatertankEmpty() {
        return $this->lastSensorData->getWatertankEmpty();
    }


    
}
