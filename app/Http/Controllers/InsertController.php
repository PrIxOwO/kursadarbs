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
        //iegūst datun no datu tabulas un apvieno tos ar users tabulu
        $data = DB::table('data')
            ->join('users', 'data.ID_user', '=', 'users.id')
            ->select('data.*', 'data.id as data_id', 'users.name as user_name')
            ->orderByDesc('data.ID') //kārtot pēc ID dilstošā secībā lai jaunākie būtu pirmie
            ->get();

        // padod datus forums skatam
        return view('forums', ['data' => $data]);
    }

    public function show($ID)
    {
        try {
            // atrod ierakstu atkarībā pēc ID
            $data = Inserter::findOrFail($ID);

            // iegūst komentus no Coment model
            $data2 = Coment::all();

            //padod datus un kometārus uz comments skatu
            return view('comments', ['data' => $data, 'data2' => $data2]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            //katram gadijumam 
            return redirect('/forms')->with('error', 'Post not found');
        }
    }

    public function showInsertForm()
    {
        // iegūst datus no datu tabulas
        $data = DB::table('data')->select('*')->get();
        // padod datus uz edit skatu
        return view('edit', ['data' => $data]);
    }

    public function storeInsert(Request $request)
    {
        // izveido jaunu ierakstu
        $data = new Inserter();

        // iegūst datus no forms
        $data->heading = $request->heading;
        $data->full_description = $request->full_description;

        // ja ir pievienotas bildes
        if ($request->hasFile('photos')) {
            // iegūst bildes failu un nosaukumu un pārvieto uz uploads/inserts mapi
            $file = $request->file('photos');
            $extension = $file->getClientOriginalExtension();
            // izveido jaunu nosaukumu lai neizdzēstu bildes ar vienādiem nosaukumiem
            $filename = time() . '.' . $extension;
            $file->move('uploads/inserts/', $filename);
            // ieraksta bildes nosaukumu datu bāzē
            $data->photos = $filename;
        } else {
            // ja nav pievienotas bildes
            $data->photos = null;
        }

        $data->ID_user = $request->ID_user;

        $data->save();


        return redirect('/forms');
    }


    public function addComment(Request $request, $ID)
    {
        // izveido jaunu komentāru
        $coment = new Coment();
        // iegūst datus no forms lauka
        $coment->coment = $request->coment;
        $coment->inserter_id = $request->inserter_id;
        $coment->post_id = $request->post_id;
        $coment->save();

        // pāraida atpakaļ uz comments skatu kas saistīts ar ieraksta id
        return redirect('/comments/' . $ID);
    }

    public function destroy($ID)
    {
        try {
            // atrod ierakstu atkarībā pēc ID
            $data = Inserter::findOrFail($ID);
            // pārbauda vai lietotājs ir ielogojies un vai viņš ir ieraksta autors
            if (Auth::check() && Auth::user()->id == $data->ID_user) {
                // dzēš ierakstu
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
            // atrod komentāru atkarībā pēc ID
            $coment = Coment::findOrFail($ID);
            // pārbauda vai lietotājs ir ielogojies un vai viņš ir komentāra autors
            if (Auth::check() && Auth::user()->id == $coment->inserter_id) {
                // dzēš komentāru
                DB::table('coment')->where('ID', $ID)->delete();
                return redirect('/comments/' . $ID);
            } else {
                return redirect('/comments/' . $ID);
            }
        } catch (\Exception $e) {
        }
    }



    public function search(Request $request)
    {
        // iegūst datus no ierakstītiem datiem
        $query = $request->input('query');
        // datubāzes vaicājums kas meklē ierakstus pēc virsraksta vai pilna apraksta
        $data = DB::table('data')
            ->join('users', 'data.ID_user', '=', 'users.id')
            ->select('data.*', 'data.id as data_id', 'users.name as user_name')
            ->where('data.heading', 'LIKE', '%' . $query . '%')
            ->orWhere('data.full_description', 'LIKE', '%' . $query . '%')
            ->get();

        // padod datus uz search skatu
        return view('search', ['data' => $data]);
    }
}
