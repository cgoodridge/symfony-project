<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class DateService
{


    public function calculateDate($year)
    {
        $currentDate = date('Y');
        $diff = $currentDate - $year;
        return $diff;
    }

}