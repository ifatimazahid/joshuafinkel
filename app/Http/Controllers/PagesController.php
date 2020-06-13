<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
   public function index(){
    return view('pages.index');
   }
     public function bookclasses(){
      return view('pages.bookclasses');
     }
     public function products(){
      return view('pages.products');
     }
     public function table(){
      return view('pages.table');
     }
}

