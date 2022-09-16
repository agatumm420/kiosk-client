<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rawilk\Printing\Printing;
use Rawilk\Printing\Contracts\Printer;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function print($json){
        $decoded= json_decode($json);
        //$printerId=1;/// how to get printerid from that thing
        Storage::disk('local')->put($decoded->data['file_name'].'.html', $decoded->data['html']);
        Pdf::loadHTML($decoded->data['html'])->save(public_path().'/storage/'.$decoded->data['file_name'].'.pdf');
        $printerId=Printing::defaultPrinterId();
        $printJob = Printing::newPrintTask()
        ->printer($printerId)
        ->file(public_path().'/storage/'.$decoded->data['file_name'].'.pdf')
        ->send();
    }
}
