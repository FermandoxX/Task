<?php
namespace App\Controller;

use App\Model\UserModel;
use App\Model\WorkingDayModel;
use App\Model\OffDaysModel;

class Salary {
    public UserModel $userModel;
    public WorkingDayModel $workingDayModel;
    public OffDaysModel $offDaysModel;

    public function __construct(UserModel $userModel,WorkingDayModel $workingDayModel,OffDaysModel $offDaysModel)
    {
        $this->userModel = $userModel;
        $this->workingDayModel = $workingDayModel;
        $this->offDaysModel = $offDaysModel;
    }

    public function index(){
        $dataOfSalary = [];
        $usersData = $this->userModel->getData();
        $response = [];

        foreach($usersData as $userData){

        $paymentPerHour = $this->userModel->paymentPerHour($userData->total_paga);
        $offDays = $this->offDaysModel->offDaysDate();
        $salary = [];

        $inNormalDaysPayment = [];
        $outNormalDaysPayment = [];
        $inWeekendDaysPayment = [];
        $outWeekendDaysPayment = [];
        $inOffDayPayment = [];
        $outOffDayPayment = [];

        $inNormalDaysHours = $this->workingDayModel->inNormalDaysHours($userData->id,$offDays);
        $outNormalDaysHours = $this->workingDayModel->outNormalDaysHours($userData->id,$offDays);
        $inWeekendDaysHours = $this->workingDayModel->inWeekendDaysHours($userData->id,$offDays);
        $outWeekendDaysHours = $this->workingDayModel->outWeekendDaysHours($userData->id,$offDays);
        $inOffDayHours = $this->workingDayModel->inOffDays($userData->id,$offDays);
        $outOffDayHours = $this->workingDayModel->outOffDays($userData->id,$offDays);

        foreach($inNormalDaysHours as $date => $hours){
            $inNormalDaysPayment[$date] = $hours * $paymentPerHour;

            if(isset($salary[$date])){
                $salary[$date] += $hours * $paymentPerHour;
            }else{
                $salary[$date] = $hours * $paymentPerHour;
            }
        }

        foreach($outNormalDaysHours as $date => $hours){
            $outNormalDaysPayment[$date] = $hours * (($paymentPerHour * 0.25)+$paymentPerHour);

            if(isset($salary[$date])){
                $salary[$date] += $hours * (($paymentPerHour * 0.25)+$paymentPerHour);
            }else{
                $salary[$date] = $hours * (($paymentPerHour * 0.25)+$paymentPerHour);
            }
        }

        foreach($inWeekendDaysHours as $date => $hours){
            $inWeekendDaysPayment[$date] = $hours * (($paymentPerHour * 0.25)+$paymentPerHour);

            if(isset($salary[$date])){
                $salary[$date] += $hours * (($paymentPerHour * 0.25)+$paymentPerHour);
            }else{
                $salary[$date] = $hours * (($paymentPerHour * 0.25)+$paymentPerHour);
            }
        }

        foreach($outWeekendDaysHours as $date => $hours){
            $outWeekendDaysPayment[$date] = $hours * (($paymentPerHour * 0.5)+$paymentPerHour);

            if(isset($salary[$date])){
                $salary[$date] += $hours * (($paymentPerHour * 0.5)+$paymentPerHour);
            }else{
                $salary[$date] = $hours * (($paymentPerHour * 0.5)+$paymentPerHour);
            }
        }

        foreach($inOffDayHours as $date => $hours){
            $inOffDayPayment[$date] = $hours * (($paymentPerHour * 0.5)+$paymentPerHour);

            if(isset($salary[$date])){
                $salary[$date] += $hours * (($paymentPerHour * 0.5)+$paymentPerHour);
            }else{
                $salary[$date] = $hours * (($paymentPerHour * 0.5)+$paymentPerHour);
            }
        }

        foreach($outOffDayHours as $date => $hours){
            $outOffDayPayment[$date] = $hours * ($paymentPerHour * 2);

            if(isset($salary[$date])){
                $salary[$date] += $hours * ($paymentPerHour * 2);
            }else{
                $salary[$date] = $hours * ($paymentPerHour * 2);
            }
        }

        $dataOfSalary['id'] = $userData->id;
        $dataOfSalary['name'] = $userData->full_name;
        $dataOfSalary['paymentForHour']= [
            'inNormalDaysHours'=>$inNormalDaysHours,
            'inNormalDaysPayment'=>$inNormalDaysPayment,
            'outNormalDaysHours'=>$outNormalDaysHours,
            'outNormalDaysPayment'=>$outNormalDaysPayment,
            'inWeekendDaysHours'=>$inWeekendDaysHours,
            'inWeekendDaysPayment'=>$inWeekendDaysPayment,
            'outWeekendDaysHours'=>$outWeekendDaysHours,
            'outWeekendDaysPayment'=>$outWeekendDaysPayment,
            'inOffDayHours'=>$inOffDayHours,
            'inOffDayPayment'=>$inOffDayPayment,
            'outOffDayHours'=>$outOffDayHours,
            'outOffDayPayment'=>$outOffDayPayment
        ];
        $dataOfSalary['monthSalary'] = $salary;
        $response[] = $dataOfSalary;
        
        }

        $jsonData = json_encode($response);
        $filePath = '../public/Response/Salary.json';
        file_put_contents($filePath, $jsonData);

        // dp($inNormalDaysPayment,$outNormalDaysPayment,$inWeekendDaysPayment,$outWeekendDaysPayment,$paymentPerHour);

    }
}