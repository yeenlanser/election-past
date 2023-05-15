<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\election_object;
use Illuminate\Http\Request;
use App\Models\geometries;
use App\Models\candidate_result;
use App\Models\arcs;

class CandidateResultController extends Controller
{
    //
     public function index(Request $request)
    {
        try {
            $objects = election_object::all();
            $data=array();            
            $geometries=array();   
            foreach ($objects as $object){
                // $result[$object->name] = $object; properties                
                $get_geometries = geometries::select('provinces.name_th','provinces.name_en','region.region_name','election_geometries.*')
                     ->join('provinces','provinces.id','=','election_geometries.province_id')->join('region','region.id','=','election_geometries.region_id')->where('election_geometries.election_object_id', $object->id)->orderBy('election_geometries.province_id', 'ASC')->orderBy('election_geometries.zone_id', 'ASC')->get();
                
                    foreach ($get_geometries as $geometry){
                        $get_result = candidate_result::where('province',$geometry->name_th)->where('zone',$geometry->zone_id)->orderBy('candidate_no', 'ASC')->get();               
                        
                        $property = array("province_name"=>	$geometry->name_th,
                                        "province_name_en"=> $geometry->name_en,
                                        "zone_id"=>	$geometry->zone_id,
                                        "code_name"=> $geometry->code_name,
                                        "code_name_en"=> $geometry->code_name_en,
                                        "region_name"=>	$geometry->region_name,
                                        "zone_detail"=>	$geometry->zone_detail,
                                        "province_id"=>	$geometry->province_id,
                                        "region_id"=> $geometry->region_id,
                                        "id"=>	$geometry->id.'-'.$geometry->zone_id,
                                        "zone_name"=> $geometry->zone_name,
                                        "result"=>	$get_result);
                     $geometries[] = array("arcs"=> json_decode($geometry->arcs),"type"=> $geometry->type,"properties"=> $property);
                }
                $data[$object->name] = array("type" => $object->type,"geometries"=>$geometries);
            }
            $arcs =  arcs::all();
            $result = array("type"=> "Topology", "arcs"=> json_decode($arcs[0]->arcs),"transform"=>array("scale"=> [0.00011034735623619586, 0.00011226504225437282],"translate"=> [97.3434779, 5.6130379]),
            "objects"=>$data);
            return response()->json(['status' => true,'data' => $result]);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => $th->getMessage(),
            ], 404);
        }
    }
}

// $year = $request->get('year');
//             if($year){            
//             // $menu = candidate_result::with('provinces')->with('party')->where('year', $year)->get();
//                      $menu = candidate_result::select('provinces.id','provinces.name_th AS province','party.id','party.name AS party','candidate_result.*')
//                     ->join('provinces','provinces.id','=','candidate_result.province_id')->join('party','party.id','=','candidate_result.party_id')->where('year', $year)->orderBy('candidate_result.province_id', 'ASC')->orderBy('candidate_result.zone', 'ASC')->get();
//             }else{
                        
//                     $menu = candidate_result::select('provinces.id','provinces.name_th AS province','party.id','party.name AS party','candidate_result.*')
//                     ->join('provinces','provinces.id','=','candidate_result.province_id')->join('party','party.id','=','candidate_result.party_id')->orderBy('candidate_result.province_id', 'ASC')->orderBy('candidate_result.zone', 'ASC')->get();
//             }