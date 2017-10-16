<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        session(['name' => 'Everan']);
        return '欢迎页面';
    }

    public function getSession()
    {
        return 'session：' . session('name');
    }

    public function admin()
    {
        return 'pass middleware';
    }
}
