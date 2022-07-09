<?php

namespace GranCapital;

use HCStudio\Orm;

class ConfigPerAcademy extends Orm
{
    protected $tblName  = 'config_per_academy';

    public function __construct()
    {
        parent::__construct();
    }

    public function getConfig(int $academy_id = null)
    {
        if (isset($academy_id) === true) {
            $sql = "SELECT
                        {$this->tblName}.value,
                        catalog_config.config
                    FROM 
                        {$this->tblName}
                    LEFT JOIN 
                        catalog_config 
                    ON 
                        catalog_config.catalog_config_id = {$this->tblName}.catalog_config_id
                    WHERE 
                        {$this->tblName}.academy_id = '{$academy_id}'
                    AND 
                        {$this->tblName}.status = '1'
                    ";
            return $this->connection()->rows($sql);
        }

        return false;
    }
}
