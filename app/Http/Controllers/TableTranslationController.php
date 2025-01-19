<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Cities;
use App\Models\CityTranslations;


class TableTranslationController extends Controller
{

    public $title;
    public $current_page = 'settings';
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->title = $this->getTableTitle('Settings');
    }

    public function index()
    {
        return view('language.tables', [
            'current_page'=>$this->current_page,
            'title'=>$this->title
        ]);
    }

    public function show($type){
        $languages = Language::orderBy('id', 'ASC')->get();
        return view('language.table_lang', [
            'type'=>$type,
            'languages'=>$languages,
            'current_page'=>$this->current_page,
            'title'=>$this->title
        ]);
    }

    public function tableShow(Request $request ){
        $type=$request->type;
        $id=$request->language_id;
        $language = Language::findOrFail($id);
       // $lang_keys = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->get();
        $sort_search = null;
        switch ($type){
            case 'city':
                $lang_keys = CityTranslations::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    // dd($sort_search);
                    // $lang_keys = $lang_keys->where('lang_key', 'like', '%' . $sort_search . '%');
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                    // dd(request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            case 'category':
                $lang_keys = CategoryTranslations::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    // dd($sort_search);
                    // $lang_keys = $lang_keys->where('lang_key', 'like', '%' . $sort_search . '%');
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                    // dd(request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            default:
        }
    }


    public function translation_save(Request $request)
    {
        // dd($request->all());
        switch ($request->type){
            case 'city':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    // dd($value);
                    $translation_def = CityTranslations::where('city_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }

                return back();
                break;
            default:
        }

    }
}
