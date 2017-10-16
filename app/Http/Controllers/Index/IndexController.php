<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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
        $str = '123456';
        $str_s = bcrypt($str);
        $password = Hash::make($str);
        $str_C = Crypt::encrypt($str);
        $d_str = Crypt::decrypt($str_C);
        return 'pass middleware and str：' . $str_s . '<br/>' . $password . '<br/>' . $str_C . '<br/>' . $d_str;
    }

    public function check()
    {
        $str = '123456';
        $pwd = Hash::make($str);
        if (Hash::check($str, $pwd)) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
