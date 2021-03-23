<?php

namespace App\Vexsolutions\Helpers;
use App\Models\Language;

class UStore{

    public static function DefLang($shopifyshop) {
        $shopifyshop->primary_locale = substr($shopifyshop->primary_locale,0,2);
        $default_lang   = Language::where('LANG_CODE', $shopifyshop->primary_locale)->count() == 0  ? 'en' : $shopifyshop->primary_locale;
        return $default_lang;
    }
}
