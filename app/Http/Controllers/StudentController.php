<?php

namespace App\Http\Controllers;

use App\Imports\SutudentImport;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "welcome";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pasted_numbers = $request->pasted_numbers;
        $pastedList = preg_split("/\r\n|\n|\r/", $pasted_numbers);

        $excelNumberList = [];
            $data = Excel::toArray(new SutudentImport,$request->file('excel_data'));
            foreach($data as $d){
                foreach($d as $f){
                array_push($excelNumberList,$f['mobile']);
                }
            }
        $allList =  array_merge($excelNumberList,$pastedList);
        $removing_duplicate = array_unique($allList);

        $print['allList']=$allList;
        $print['removing_duplicate'] = $removing_duplicate;

        $tags = implode(', ', $allList);

        // $this->aakashSms($removing_duplicate,"Hello tesing is done successfully");
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validation
       
        //  $validated_data = $request->validate([
        //     'excel_data'=>'required|mimes:xls,xlsx'
        // ]);
        // dd($request->all());

        try{

            $data = Excel::toArray(new SutudentImport,$request->file('excel_data'));
            $headings = (new HeadingRowImport())->toArray($request->file('excel_data'));
            $column = count($data[0]); 
          
            $rows = count($data[0][0]);
            // dd($data);
             return view('sms',compact('data','headings','rows'))->with('no');

        }catch(Exception $err){
            return $err->getMessage()
;        }
        
    }

    public function sendSms(Request $request){

        $data = Excel::toArray(new SutudentImport(),$request->file('excel_data'));
        $headings = (new HeadingRowImport())->toArray($request->file('excel_data'));
        return $headings;

        dd("stop");
        $path = $request->file('excel_data')->getPathname();
        if($request->has('header')){
            $data = Excel::load($path,function($header){})->get()->toArray();
        }else{
            $data = array_map('str_getcsv',file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 2);
    
            $newString = mb_convert_encoding($csv_data, "UTF-8", "auto");
                return response()->json($newString);
            // $csv_data_file = CsvData::create([
            //     'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            //     'csv_header' => $request->has('header'),
            //     'csv_data' => json_encode($data)
            // ]);
        } else {
            return redirect()->back();
        }


        dd($data);

        dd('dont go down');
        $path = $request->file('excel_data')->getPathName();
        $data = array_map('str_getcsv', file($path));
        $csv_data = array_slice($data, 0, 2);

        return $csv_data;


        $d = Excel::toArray([],$request->file('excel_data'));
        $collection = Excel::toCollection([], $request->file('excel_data'));
        return $collection;
        $data =  $d[0];
       
        $numbers = [];
        foreach($data as $key => $sendingdata){
            $mobile = $sendingdata[1];
       
          $message = 'You obtained'.$sendingdata[2].'in english'.$sendingdata[3].'in Math';

       $api_key = '26131CBCBE0BDF';
          $contacts = $mobile;
          $from = 'SMSBit';
          $routeid = 116;
          $campaign = 5648;
          $sms_text = urlencode($message);
        
          $api_url = "https://login.spellsms.com/base/smsapi/index.php?key=".$api_key."&campaign=".$campaign."&routeid=".$routeid."&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
        
        //Submit to server
        
        $response = file_get_contents( $api_url);
        echo $response;
          }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $apiKey = '24e37a4f557a608b2d05431670f25d75b464dea735d08297c7eb4ca26b5afbc8';
        // $args = http_build_query(array(
        //   'auth_token'=> $apiKey,
        //   'to'    => $mobile,
        //   'text'  => $message));
        //   $url = "https://sms.aakashsms.com/sms/v3/send";
        //   // $url = "http://aakashsms.com/admin/public/sms/v3/send/";

        //   # Make the call using API.
        //   $ch = curl_init();
        //   curl_setopt($ch, CURLOPT_URL, $url);
        //   curl_setopt($ch, CURLOPT_POST, 1); ///
        //   curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //   // Response
        //   try{
        //       $response = curl_exec($ch);

        //       curl_close($ch);
        //       if($response){
        //           return $response;
        //           }else
        //           {
        //               return "error in sending message";
        //         }
        //   }catch(Exception $err){
        //       return $err->getMessage();
        //   }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
