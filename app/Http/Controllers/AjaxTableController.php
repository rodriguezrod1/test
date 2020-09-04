<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AjaxTableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Update the specified resource in update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data   = $request->data;
        $tabla  = $request->tabla;
        $campo  = $request->campo;
        $id     = $request->id;
        switch ($tabla) {
            case 'users':
                $post = User::find($id);
                switch ($campo) {
                    case 'name':
                        $validar = array('data' => 'required|string|max:100');
                        break;
                    case 'last_name':
                        $validar = array('data' => 'required|string|max:100');
                        break;
                    case 'contact_number':
                        $validar = array('data' => 'required|numeric');
                        break;                    
                    case 'email':
                        if ($post->email == $request->data) {
                            return response()->json([
                                'status'  => 'error',
                                'message' => 'Email already exists',
                                'code'    => 0
                            ]);
                        }
                        $validar = array('data' => 'required|string|max:100|email');
                        break;
                    default:                        
                        break;
                }
                $validator = Validator::make($request->all(), $validar);
                if ($validator->fails()) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => $validator->errors()->all(),
                        'code'    => 0
                    ]);
                }
                $post->$campo  = $data;
                $post->save();
                break;
            case '':
                break;          
            default:
                break;
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Field Updated successfully',
            'code'    => 0
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        DB::table($data['tabla'])->where('id', $data['id'])->delete();
        return response()->json([
            'status'  => 'success',
            'message' => 'Deleted Successfully.',
            'code'    => 0
        ]);
    }
}
