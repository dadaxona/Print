<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function printer(Request $request)
    {
        $dt= Carbon::now('Asia/Tashkent');
        $data1 = $dt->toDateTimeString();
        $connector = new WindowsPrintConnector("XP-58");
        $printer = new Printer($connector);
        $printer->initialize();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
        $printer->text(env('HOSPITIAL_NAME') ."\n");
        $printer->selectPrintMode();
        $printer -> text( $data1."\n");
        $printer -> text( $request->text."\n");
        $printer->feed(4);
        $printer -> cut();
        $printer -> close();
    }
}
