<?php 
namespace App\Model;

use Core\Model;

class UserModel extends Model{
    public $tableName = 'users';
    public $primaryKey = 'id';

    public function paymentPerHour($salary){
        $hoursInMonth = 160;
        
        $paymentPerHour = $salary/$hoursInMonth;
        return $paymentPerHour;
    }


}