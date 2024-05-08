<?php 
namespace App\Model;

use Core\Model;

class OffDaysModel extends Model{
    public $tableName = 'off_days';
    public $primaryKey = 'id';

    public function offDaysDate(){
        $offDaysDate = $this->getData();
        $offDays = [];

        foreach($offDaysDate as $offDayDate){
            $offDays[] = $offDayDate->date;
        }

        return $offDays;
    }


}