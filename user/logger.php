<?php
function logger($log_msg){
    $log_filename = "C:/UwAmp/www/RealEstate/pscity/Log";

    if (!file_exists($log_filename)) 
    {
        mkdir($log_filename, 0777, true);
    }
    $ip=$_SERVER['REMOTE_ADDR'];
    $time= date('d-m-Y h:i:s');
    $log_file_data = $log_filename.'/Log_' . date('d-M-Y ') . '.log';
   $log_msg.="$ip\t$time\t$log_msg\r";
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);  
}
?>