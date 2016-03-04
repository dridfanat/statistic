<?php

class Utils{

public function mkConvert($duration) {
    

$hours = (int)($duration/60/60);
$minutes = (int)($duration/60)-$hours*60;
$seconds = (int)$duration-$hours*60*60-$minutes*60;  

if (1==mb_strlen($hours)) $hours='0'.$hours ; 
if (1==mb_strlen($minutes)) $minutes='0'.$minutes ;
if (1==mb_strlen($hours)) $seconds='0'.$seconds ;

    return ($hours.':'.$minutes);
}





public function efficiency($data) {      

$time= explode(':', $data->statisticr->t_cels);
if ($time[0]==0&&$time[1]==0)    return 0;
 
$timew= explode(':', Utils::mkConvert($data->clockr->time));

if ($timew[0]==0&&$timew[1]==0)    return 0;
 
$result = substr(
         ($time[0]*60+$time[1]+$data->statisticr->dialed+45+($data->statisticr->ftd*60))/($timew[0]*60+$timew[1])
         ,0,4 );

 return $result;
}  





public function efficiencyUser($data) {      
$time= explode(':', Utils::mkConvert($data->t_cels));
if ($time[0]==0&&$time[1]==0)    return 0;
 
$timew= explode(':', Utils::mkConvert($data->clockr->time));

if ($timew[0]==0&&$timew[1]==0)    return 0;
 
$result = substr(
         ($time[0]*60+$time[1]+$data->dialed+45+($data->ftd*60))/($timew[0]*60+$timew[1])
         ,0,4 );

 return $result;
} 



}