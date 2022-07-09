<?php

namespace GranCapital;

use HCStudio\Orm;

class Academy extends Orm
{
    protected $tblName = 'academy';
    public $configs = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function getConfig(string $config = null)
    {
        if($key = array_search($config, array_column($this->configs, 'config')) > -1)
        {
            return $this->configs[$key]['value'];
        }

        return '';
    }

    public function loadConfigs(int $academy_id = null)
    {
        return $this->configs = (new ConfigPerAcademy)->getConfig($academy_id);
    }
}
