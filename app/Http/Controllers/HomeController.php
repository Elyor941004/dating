<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Cities;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $title;
    public $current_page = 'home';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Home');
    }

    public function index(){

        return view('index', [
            'title'=>$this->title,
            'current_page'=>$this->current_page,
        ]);
    }
    public function welcome(){

        return view('welcome');
    }

    public function setCities(){
        if(!Cities::withTrashed()->exists()){
            $jsonPath = public_path('json/cities.json');
            $response = file_get_contents($jsonPath);
            $cities = json_decode($response, true);
            foreach ($cities as $city){
                if(!Cities::where('name', $city['region'])->exists()){
                    $model_region = new Cities();
                    $model_region->name = $city['region'];
                    $model_region->type = 'region';
                    $model_region->parent_id = 0;
                    $model_region->lng = $city['long'];
                    $model_region->lat = $city['lat'];
                    $model_region->save();
                    foreach($city['cities'] as $city_district){
                        $model = new Cities();
                        $model->name = $city_district['name'];
                        $model->type = 'district';
                        $model->parent_id = $model_region['id'];
                        $model->lng = $city_district['long'];
                        $model->lat = $city_district['lat'];
                        $model->save();
                    }
                }else{
                    $model_region = Cities::where('name', $city['region'])->first();
                    $model_region->lng = $city['long'];
                    $model_region->lat = $city['lat'];
                    $model_region->save();
                }
            }
        }
    }

    public function getCities(Request $request){
        $language = 'ru';
        $cities = Cities::where('parent_id', 0)->orderBy('id', 'ASC')->get();
        $data = [];
        foreach ($cities as $city){
            $city_translate = table_translate_title($city,'city', $language);
            $cities_ = [];
            foreach ($city->getDistricts as $district){
                $district_translate = table_translate_title($district,'city', $language);
                $cities_[] = [
                    'id'=>$district->id,
                    'name'=>$district_translate,
                    'lat'=>$district->lat,
                    'long'=>$district->lng
                ];
            }
            $data[] = [
                'id'=>$city->id,
                'name'=>$city_translate,
                'lat'=>$city->lat,
                'long'=>$city->lng,
                'cities'=>$cities_,
            ];
        }
        if(!empty($data)){
            return response()->json([
                'data' => $data ?? NULL,
                'status' => true,
                'message' => 'Success'
            ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No cities'
            ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE); // $error_type
        }
    }

    public function getRegions(Request $request){
        $language = 'ru';
        // $cities = Cities::where('parent_id', 0)->orderBy('id', 'ASC')->get();
        $cities = Cities::where('parent_id', 0)->whereIn('name', ['Toshkent shahri', 'Samarqand viloyati', 'Toshkent viloyati'])->orderBy('id', 'ASC')->get();
        $data = [];
        foreach ($cities as $city){
            $city_translate = table_translate_title($city,'city', $language);
            $data[] = [
                'id'=>$city->id,
                'name'=>$city_translate,
            ];
        }
        if(!empty($data)){
            return response()->json([
                'data' => $data ?? NULL,
                'status' => true,
                'message' => 'Success'
            ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No cities'
            ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE); // $error_type
        }
    }
}
