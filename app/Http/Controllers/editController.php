<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inserter;

class editController extends Controller
{
    public function index()
    {
        $data = DB::table('data')->get();
        return view('list', ['data' => $data]);
    }

    public function showUpdate($ID)
    {
        $data = DB::table('data')->where('ID', $ID)->first();
        return view('update', ['data' => $data]);
    }
    public function updateData(Request $request)
    {
        $data = Inserter::find($request->ID);
        dd($data);

        $data->heading = $request->heading;
        $data->short_description = $request->short_description;
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

        
        if ($request->hasFile('photos2')) {
            $file = $request->file('photos2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_2.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->photos2 = $filename;
        } else {
            $data->photos2 = null;
        }

        if ($request->hasFile('photos3')) {
            $file = $request->file('photos3');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_3.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->photos3 = $filename;
        } else {
            $data->photos3 = null;
        }

        if ($request->hasFile('photos4')) {
            $file = $request->file('photos4');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_4.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->photos4 = $filename;
        } else {
            $data->photos4 = null;
        }

        if ($request->hasFile('photos5')) {
            $file = $request->file('photos5');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_5.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->photos5 = $filename;
        } else {
            $data->photos5 = null;
        }


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/inserts/', $filename);
            $data->file = $filename;
        } else {
            $data->file = null;
        }

        $data->link = $request->link;
        $data->save();
        return redirect('/confirmation')->with('data', $data);


       
    }
}
