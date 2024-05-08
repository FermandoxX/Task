<?php 
namespace App\Model;

use Core\Model;


class WorkingDayModel extends Model{
    public $tableName = 'working_days';
    public $primaryKey = 'id';

    public function inNormalDaysHours($userId,$offDays){
        $hours = [];
        $allData = $this->getData(['user_id'=>$userId]);
        $normalDaysDates = [];

        foreach($allData as $data){
            $dayOfWeek = date('l', strtotime($data->date));

            if($dayOfWeek != 'Saturday' && $dayOfWeek != 'Sunday' && !in_array($data->date,$offDays)){
                $normalDaysDates[] = $data->date; 
            }
        }

        foreach($normalDaysDates as $normalDayDate){
            $daysHours = $this->getData(['user_id'=>$userId,'date'=>$normalDayDate]);
            foreach($daysHours as $dayHour){
                $month = date('m', strtotime($dayHour->date));
                $year = date('Y', strtotime($dayHour->date));
                $key = $year . '-' . $month;

                if(!isset($hours[$key])){
                    $hours[$key] = 0;
                }

                if($dayHour->hours > 8){
                    $hours[$key] += 8;
                    continue;
                }

                $hours[$key] += $dayHour->hours; 
            } 
        }

        return $hours;
    }

    public function outNormalDaysHours($userId,$offDays){
        $hours = null;
        $allData = $this->getData(['user_id'=>$userId]);
        $normalDaysDates = [];

        foreach($allData as $data){
            $dayOfWeek = date('l', strtotime($data->date));

            if($dayOfWeek != 'Saturday' && $dayOfWeek != 'Sunday' && !in_array($data->date,$offDays)){
                $normalDaysDates[] = $data->date; 
            }

        }

        foreach($normalDaysDates as $normalDayDate){
            $daysHours = $this->getData(['user_id'=>$userId,'date'=>$normalDayDate]);
            
            foreach($daysHours as $dayHour){
                $month = date('m', strtotime($dayHour->date));
                $year = date('Y', strtotime($dayHour->date));
                $key = $year . '-' . $month;

                if(!isset($hours[$key])){
                    $hours[$key] = 0;
                }

                if($dayHour->hours > 8){
                    $outHoursInDay = $dayHour->hours - 8;
                    $hours[$key] += $outHoursInDay;
                }
            } 
        }

        return $hours;
    }

    public function inWeekendDaysHours($userId,$offDays){
        $hours = [];
        $allData = $this->getData(['user_id'=>$userId]);
        $weekendDaysDates = [];

        foreach($allData as $data){
            $dayOfWeek = date('l', strtotime($data->date));

            if(($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday') && !in_array($data->date,$offDays)){
                $weekendDaysDates[] = $data->date; 
            }

        }

        foreach($weekendDaysDates as $weekendDayDate){
            $daysHours = $this->getData(['user_id'=>$userId,'date'=>$weekendDayDate]);
            foreach($daysHours as $dayHour){
                $month = date('m', strtotime($dayHour->date));
                $year = date('Y', strtotime($dayHour->date));
                $key = $year . '-' . $month;

                if(!isset($hours[$key])){
                    $hours[$key] = 0;
                }

                if($dayHour->hours > 8){
                    $hours[$key] += 8;
                    continue;
                }

                $hours[$key] += $dayHour->hours; 
            } 
        }

        return $hours;
    }

    public function outWeekendDaysHours($userId,$offDays){
        $hours = [];
        $allData = $this->getData(['user_id'=>$userId]);
        $weekendDaysDates = [];

        foreach($allData as $data){
            $dayOfWeek = date('l', strtotime($data->date));

            if(($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday') && !in_array($data->date,$offDays)){
                $weekendDaysDates[] = $data->date; 
            }

        }

        foreach($weekendDaysDates as $weekendDayDate){
            $daysHours = $this->getData(['user_id'=>$userId,'date'=>$weekendDayDate]);
            foreach($daysHours as $dayHour){
                $month = date('m', strtotime($dayHour->date));
                $year = date('Y', strtotime($dayHour->date));
                $key = $year . '-' . $month;

                if(!isset($hours[$key])){
                    $hours[$key] = 0;
                }

                if($dayHour->hours > 8){
                    $outHoursInDay = $dayHour->hours - 8;
                    $hours[$key] += $outHoursInDay;
                }
            } 
        }

        return $hours;
    }

    public function inOffDays($userId,$offDays){
        $allData = $this->getData(['user_id'=>$userId]);
        $hours = [];

        foreach($offDays as $offDay){
            foreach($allData as $data){
                if($data->date == $offDay){
                    $month = date('m', strtotime($data->date));
                    $year = date('Y', strtotime($data->date));
                    $key = $year . '-' . $month;

                    if(!isset($hours[$key])){
                        $hours[$key] = 0;
                    }

                    if($data->hours > 8){
                        $hours[$key] += 8;
                        continue;
                    }
                    $hours[$key] += $data->hours;
                    
                }
            }
        }

        return $hours;
    }

    public function outOffDays($userId,$offDays){
        $allData = $this->getData(['user_id'=>$userId]);
        $hours = [];

        foreach($offDays as $offDay){
            foreach($allData as $data){
                if($data->date == $offDay){
                    $month = date('m', strtotime($data->date));
                    $year = date('Y', strtotime($data->date));
                    $key = $year . '-' . $month;

                    if(!isset($hours[$key])){
                        $hours[$key] = 0;
                    }

                    if($data->hours > 8){
                        $outHoursInDay = $data->hours - 8;
                        $hours[$key] += $outHoursInDay;
                    }
                    
                }
            }
        }

        return $hours;
    }




}