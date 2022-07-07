<?php

namespace GranCapital;

use HCStudio\Orm;

class GainPerBroker extends Orm {
	protected $tblName = 'gain_per_broker';
	public function __construct() {
		parent::__construct();
	}

	public function getGainPerDay(int $broker_id = null,string $day = null)
	{
        if(isset($broker_id) === true)
        {
            $begin_of_day = strtotime(date("Y-m-d 00:00:00",strtotime($day)));
            $end_of_day = strtotime(date("Y-m-d 23:59:59",strtotime($day)));
            
            $sql = "SELECT 
                        {$this->tblName}.gain
                    FROM 
                        {$this->tblName}
                    WHERE 
                        {$this->tblName}.status = '1'
                    AND 
                        {$this->tblName}.create_date
                    BETWEEN 
                        {$begin_of_day}
                    AND 
                        {$end_of_day}
                    AND 
                        {$this->tblName}.broker_id = '{$broker_id}'
                    ";
                    
            return $this->connection()->field($sql);
        }

        return false;
	}
	
    public static function addGain(int $broker_id = null,float $gain = null,string $day = null) : bool
    {
        $GainPerBroker = new GainPerBroker;
            
        if($gain_per_broker_id = $GainPerBroker->getGainPerDayId($broker_id,$day))
        {
            $GainPerBroker->cargarDonde("gain_per_broker_id = ?",$gain_per_broker_id);
        } else {
            $GainPerBroker->broker_id = $broker_id;
            $GainPerBroker->create_date = strtotime(date("Y-m-d 23:59:59",strtotime($day)));
        }

        $GainPerBroker->gain = $gain;

        return $GainPerBroker->save();
    }

    public function getGainPerDayId(int $broker_id = null,string $day = null)
	{
        if(isset($broker_id) === true)
        {
            $begin_of_day = strtotime(date("Y-m-d 00:00:00",strtotime($day)));
            $end_of_day = strtotime(date("Y-m-d 23:59:59",strtotime($day)));
        
            $sql = "SELECT 
                        {$this->tblName}.{$this->tblName}_id
                    FROM 
                        {$this->tblName}
                    WHERE 
                        {$this->tblName}.status = '1'
                    AND 
                        {$this->tblName}.create_date
                    BETWEEN 
                        {$begin_of_day}
                    AND 
                        {$end_of_day}

                    AND 
                        {$this->tblName}.broker_id = '{$broker_id}'
                    ";
            
            return $this->connection()->field($sql);
        }

        return false;
	}
    
    public function getAllGainsPerBroker(int $broker_id = null)
	{
        if(isset($broker_id) === true)
        {
            $sql = "SELECT 
                        {$this->tblName}.gain
                    FROM 
                        {$this->tblName}
                    WHERE 
                        {$this->tblName}.status = '1'
                    AND 
                        {$this->tblName}.broker_id = '{$broker_id}'
                    ";
            
            return $this->connection()->column($sql);
        }

        return false;
	}
}