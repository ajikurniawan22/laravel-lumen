<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\City; 
use Exception;
use DB;

class CityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
        //CRUD technical test MRA Media
        
    public function storeCity(Request $request)
    {
        $token = $request->header('X-CSRF-Token');
        $adm_token = DB::select("SELECT * FROM adm_token where token = ?",[$token]);
              $data = new City($request->all());
            $create = $data->save();
            if($create){
                $response = [
                    "status" => true,
                    "message" => "Data city inserted",
                ];
                $http_code = 200;
            }else{
                $response = [
                    "status" => false,
                    "message" => "Data city failed to insert",
                ];
                $http_code = 422;
            }
            return response($response, $http_code);
        try {

            if (!$adm_token) {
                throw new Exception("Unauthorized", 401);
            }
            
      
            
        } catch (Exception $exception) {
            $response  = [
                "data" =>[],
                "status"  => $exception->getCode(),
                "message" => $exception->getMessage(),
            ];
            return response($response, $exception->getCode());
        }
    }

    public function getDetailCity(Request $request, $id)
    {
        $data = City::where('id', $id)->get();
        try{
            if (!$data) {
                throw new Exception("Data can not be found", 200);
            }

            $response = [
                "status" => true,
                "message" => "Data City found",
                "data" => $data
            ];

            return response()->json($response, 200);
        }catch (Exception $exception){
            $response  = [
                "data" =>[],
                "status"  => $exception->getCode(),
                "message" => $exception->getMessage(),
            ];
            return response($response, $exception->getCode());
        }
    }

    public function editCity(Request $request, $id)
    {   
        $token = $request->header('X-CSRF-Token');
        $adm_token = DB::select("SELECT * FROM adm_token where token = ?",[$token]);
        try {

            if (!$adm_token) {
                throw new Exception("Unauthorized", 401);
            }

            $post = City::find($id);
    
            $data = [
                'province_id' => $request->province_id,
                'name' => $request->name,
                'is_active' => $request->is_active
            ];
     
            $update = $post->update($data);
    
            if ($update) {
                $response  = [
                    "data" => $data,
                    "status"  => true,
                    "message" => "Update City success...",
                ];
                $http_code = 200;
            } else {
                $response  = [
                    "data" => $data,
                    "status"  => false,
                    "message" => "Update City failed...",
                ];
                $http_code = 422;
            }
            
            return response($response, $http_code);
            
        } catch (Exception $exception) {
            $response  = [
                "data" =>[],
                "status"  => $exception->getCode(),
                "message" => $exception->getMessage(),
            ];
            return response($response, $exception->getCode());
        }
    }

    public function destroyCity(Request $request, $id)
    {
        $token = $request->header('X-CSRF-Token');
        $adm_token = DB::select("SELECT * FROM adm_token where token = ?",[$token]);
        try {
            if (!$adm_token) {
                throw new Exception("Unauthorized", 401);
            }

            $data = City::find($id);
            $delete = $data->delete();
    
            if ($delete) {
                $response  = [
                    "status"  => true,
                    "message" => "Delete City success...",
                ];
                $http_code = 200;
            } else {
                $response  = [
                   "status"  => false,
                    "message" => "Delete City failed...",
                ];
            }
    
            return response($response, $http_code);

        } catch (Exception $exception) {
            $response  = [
                "data" =>[],
                "status"  => $exception->getCode(),
                "message" => $exception->getMessage(),
            ];
            return response($response, $exception->getCode());
        }
    }
}
