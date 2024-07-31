<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\View\Components\Alert;
// use Dotenv\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Html\Column;

class DataTableController extends Controller
{
    //

    public function clientSide(Request $request){
        
        $data = new User;
        // memfilter data
        if($request->get('search')){
            $data = $data->where('name','LIKE','%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }

        $data = $data->get();

        return view('datatable.clientside', compact('data','request'));
    }

    public function serverSide(Request $request){
        
        
        // memfilter data
        if($request->ajax()){
            $data = new User;
            $data = $data->latest();
            return DataTables::of($data)
            ->addColumn('no', function($data){
                return "ini nomer";
            })
            ->addColumn('photo', function($data){
                return '<img src="'. asset('storage/photo-user/'.$data->image) .'" alt="" style="width:5rem; height:5rem">';
            })
            ->addColumn('nama', function($data){
                return $data->name;
            })
            ->addColumn('email', function($data){
                return $data->email;
            })
            ->addColumn('action', function($data){
                return ' <a href="'.route('user.edit',['id' => $data->id]).'" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                <a href="#"  data-toggle="modal" data-target="#modal-hapus'.$data->id.'" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>';
            })
            //adanya rawcolumn ini karana di atas terdapat tag htmlnya 
            ->rawColumns(['photo','action'])
            ->make(true);
        }
       

        return view('datatable.serverside', compact('request'));
    }

}
