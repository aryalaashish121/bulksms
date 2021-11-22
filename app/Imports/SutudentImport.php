<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class SutudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return [
           "A"=>$row[0]
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
   
}


    // public function sendSms(Request $request){
        
    //     $data = Student::all();
    //       $numbers = [];
    //       foreach($data as $key => $sendingdata){
  
    //           // $mobile = $sendingdata-;
    //       $mobile = $sendingdata->phone;
              
    //       $message = $sendingdata->message;
    //       //   $message = "You obtained".$sendingdata[2]."in english".$sendingdata[3]."in Math";
    //       $api_key = '26131CBCBE0BDF';
    //       $contacts = $mobile;
    //       $from = 'SMSBit';
    //       $routeid = 116;
    //       $campaign = 5648;
    //       $sms_text = urlencode('Hello People, have a great day'.$message);
        
    //       $api_url = "https://login.spellsms.com/base/smsapi/index.php?key=".$api_key."&campaign=".$campaign."&routeid=".$routeid."&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
        
    //     //Submit to server
        
    //     $response = file_get_contents( $api_url);
    //     echo $response;
    //       }
    //     }
