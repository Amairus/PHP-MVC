<?php

namespace App\Services\CarType;

use App\Libraries\Middleware;

class OldCarType
{
    protected $type = 'Old';
    protected $iconPath;
    protected $errIconPath = 'public/icons/err.png';

    public function getIcon()
    {
        $this->iconPath  =  'public/icons/'.$this->type.'.png';
        if(Middleware::fileExists($this->iconPath))
        return $this->iconPath;
        else
        return $this->errIconPath;
    }

}