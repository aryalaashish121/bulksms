<?php

namespace App\Http\Controllers;

use App\Imports\DynamicImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class DynamicSmsController extends Controller
{
    public function handle(Request $request){
       $text = $request->content;
        $data = Excel::toArray(new DynamicImport(),$request->file('excel_data'));
        $headings = (new HeadingRowImport())->toArray($request->file('excel_data'));
        $runtime = 0;
            foreach($data[0] as $value){
                $runtime++;
                $text = $request->content;
                foreach($headings[0][0] as $key=> $head){
                        $indexval = strtolower($head);
                        $text =str_replace("#{$indexval}#",$value[$indexval],$text);
                    }
                    echo $text;

                    echo Carbon::now();
                             
                //     $args = http_build_query(array(
                //         'auth_token'=> '24e37a4f557a608b2d05431670f25d75b464dea735d08297c7eb4ca26b5afbc8',
                //         'to'    =>  $value['phone'],
                //         'text'  => $text
                //     ));
                // $url = "https://sms.aakashsms.com/sms/v3/send/";
            
                // # Make the call using API.
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, $url);
                // curl_setopt($ch, CURLOPT_POST, 1); ///
                // curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                // // Response
                // $response = curl_exec($ch);
                // curl_close($ch);     
                   
                // echo $response;
                }
     }
         
     public function getText($text){
         
     }
    public function aakashSms($contactList,$message){

        $contacts = implode(',',$contactList);
        $args = http_build_query(array(
            'auth_token'=> '24e37a4f557a608b2d05431670f25d75b464dea735d08297c7eb4ca26b5afbc8',
            'to'    =>  $contacts,
            'text'  => $message
        ));
    $url = "https://sms.aakashsms.com/sms/v3/send/";

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1); ///
    curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // Response
    $response = curl_exec($ch);
    curl_close($ch);     
       
    echo $response;
       
    }
}
