<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Knowledge;
use Facades\App\Repository\Pages;

class KnowledgeController extends Controller
{
 public function index() {
     $knowledges = Knowledge::find(1)->first();

    //  dd($knowledge);

     return view('frontend.knowledge.index', compact('knowledges'));
 }
}
