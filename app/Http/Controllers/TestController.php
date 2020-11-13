<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Parser;
class TestController extends Controller
{
    public function index()
    {
        $parser = new Parser("https://www.olx.ua/transport/legkovye-avtomobili/daewoo/kremenchug");
        $parser->run();
        return 0;
    }
}
