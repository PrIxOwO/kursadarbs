<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Inserter;
use Illuminate\Support\Facades\Auth;
use App\Models\Coment;

class InsertController extends Controller
{
    public function showData()
    {
        $data = DB::table('data')
            ->join('users', 'data.ID_user', '=', 'users.id')
            ->select('data.*', 'data.id as data_id', 'users.name as user_name')
            ->get();
    
        return view('forums', ['data' => $data]);
    }
    

    public function show($ID)
    {
        try {
            $data = Inserter::findOrFail($ID);
            $data2 = Coment::all(); 
            return view('comments', ['data' => $data, 'data2' => $data2]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/forms')->with('error', 'Post not found');
        }
    }
    
    

    public function shoComent()
    {
        $data2 = DB::table('coment')
            ->join('users', 'data2.inserter_id', '=', 'users.id')
            ->select('data2.*', 'data2.id as data_id', 'users.name as user_name')
            ->get();
    
        return view('forums', ['data2' => $data2]);
    }
    public function showComments()
    {
        $data2 = Coment::all(); 
        return view('coments', ['data2' => $data2]); 
    }
    

    public function showInsertForm()
    {
        $data = DB::table('data')->select('*')->get();
        return view('edit', ['data' => $data]);
    }
    
    public function storeInsert(Request $request)
    {
        $data = new Inserter();
        

        $data->heading = $request->heading;
        $data->full_description = $request->full_description;
        
      
        if ($request->hasFile('photos')) {
            $file = $request->file('photos');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->photos = $filename;
        } else {
            $data->photos = null;
        }

        $data->ID_user = $request->ID_user;
        
        $data->save();
        
      
        return redirect('/forms');
    }

    public function addComment(Request $request, $ID)
    {
        $coment = new Coment();
        $coment->coment = $request->coment; 
        $coment->inserter_id = $request->inserter_id;
        $coment->post_id = $request->post_id;
        $coment->save();
    
        return redirect('/comments/' . $ID);
    }

    public function destroy($ID)
    {
        try {
            $data = Inserter::findOrFail($ID);
            if (Auth::check() && Auth::user()->id == $data->ID_user) {
                DB::table('data')->where('ID', $ID)->delete();
                return redirect('/forms');
               
            } else {
                return redirect('/forms')->with('error', 'kaut kas sapisas :D');
            }
        } catch (\Exception $e) {
            return redirect('/forms')->with('error', 'a nu es nez');
        }
    }

    public function deleteComment($ID)
    {
        try {
            $coment = Coment::findOrFail($ID);
            if (Auth::check() && Auth::user()->id == $coment->inserter_id) {
                DB::table('coment')->where('ID', $ID)->delete();
                return redirect('/comments/' . $ID);
            } else {
                return redirect('/comments/' . $ID);
            }
        } catch (\Exception $e) {
            
        }
    }
    
    
    
}
