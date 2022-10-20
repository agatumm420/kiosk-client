<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rawilk\Printing\Facades\Printing;
use Rawilk\Printing\Contracts\Driver;
use Rawilk\Printing\Drivers\Cups\Entity\Printer;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrintController extends Controller
{
    public function print(Request $request){
        $decoded=$request->input('data');
        //dd($decoded);
        //$printerId=1;/// how to get printerid from that thing
        Storage::disk('local')->put($decoded['file_name'].'.html', $decoded['html']);
        Pdf::loadHTML($decoded['html'])->save(public_path().'/storage/'.$decoded['file_name'].'.pdf');
        // $driver=new Driver();
        // $printing= new Printing($driver, '40');
        $printerId=Printing::defaultPrinterId();
        $printerStatus=Printing::driver('cups')->printer('45')->status();
        if($printerStatus=='enabled'||$printerStatus=='idle' || $printerStatus=='accepting'){
            $printJob =Printing::driver('cups')
            ->newPrintTask()
            ->printer('45')
            ->file(public_path().'/storage/'.$decoded['file_name'].'.pdf')
            ->send();
            $response=Http::get('https://ws.galaxy-centrum.pl/api/stop_print/'.$decoded['file_id']);
            return response()->json([
                'data'=>[
                    'hello'=>'world'
                ]
                ]);
        }
        else{
            //Log::emergency('Printer disabled');
            $response=Http::get('https://ws.galaxy-centrum.pl/api/printer_error/'.$printerStatus);
        }




    }
}
