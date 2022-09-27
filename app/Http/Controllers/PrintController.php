<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rawilk\Printing\Facades\Printing;
use Rawilk\Printing\Contracts\Driver;
use Rawilk\Printing\Drivers\Cups\Entity\Printer;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $printJob =Printing::driver('cups')
        ->newPrintTask()
        ->printer('45')
        ->file(public_path().'/storage/'.$decoded['file_name'].'.pdf')
        ->send();
        return response()->json([
            'data'=>[
                'hello'=>'world'
            ]
            ]);
    }
}
