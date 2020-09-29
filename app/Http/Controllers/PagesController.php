<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.index');
    }

    public function contact($type)
    {
        if($type == 'fibra'){
            $service = 'Fibra';
        } elseif ($type == 'wireless') {
            $service = 'Inalámbrico';
        }else{
            $service = 'Información';
        }
        return view('pages.contact', compact('service'));
    }

}
