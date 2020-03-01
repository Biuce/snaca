<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/2/9
 * Time: 17:29
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Repository\Admin\ConfigRepository;

class LanguageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function setLocale($lang){

        if (array_key_exists($lang, config('app.locales'))) {
            session(['applocale' => $lang]);
            $array = ["value" => $lang];
            ConfigRepository::update(3, $array);
        }
        return back()->withInput();
    }
}