<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\View\Components\Alert;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
class HomeController extends Controller
{
    //
    public $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function index(Request $request){
        
        $data = new User;
        // memfilter data
        if($request->get('search')){
            $data = $data->where('name','LIKE','%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }
        // untuk menampilkan semua data termasuk yang sudah terhapus
        // $data = $data->withTrashed();

        // untuk menapilkan hanya data yang sudah terhapus
        // $data = $data->onlyTrashed();
        $data = $data->get();

        return view('index', compact('data','request'));
    }
    public function assets(Request $request){
        
        $data = new User;
        // memfilter data
        if($request->get('search')){
            $data = $data->where('name','LIKE','%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }
        if($request->get('tanggal')){
            $data = $data->where('name','LIKE','%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }
        // untuk menampilkan semua data termasuk yang sudah terhapus
        // $data = $data->withTrashed();

        // untuk menapilkan hanya data yang sudah terhapus
        // $data = $data->onlyTrashed();
        $data = $data->get();

        if($request->get('export') == 'pdf')
        {
        $pdf = Pdf::loadView('pdf.assets',['data' => $data] );
        // untuk menampilkan pdf
        return $pdf->stream('Data Assets.pdf');
        // lansung download
        // return $pdf->download('Data Assets.pdf');
        }

        return view('assets', compact('data','request'));
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
            $validator =Validator::make($request->all(),[
                'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
                'email' => 'required|email',
                'nama' => 'required',
                'password' => 'required',
            ]);
            // ket: kalau validasi nya gagal / ada yang kurang di validasinya maka akan
            // balik lagi ke halaman sebelumnya dengan apa yang dia input 
             
            if($validator->fails()) return redirect()->back()->withInput()->withError($validator);
            // dd($request->all());
            $photo = $request->file('photo');
            $fileName = date('Y-m-d').rand(100,999) . "." . $photo->getClientOriginalExtension();
            $path = 'photo-user/'.$fileName;
            Storage::disk('public')->put($path,file_get_contents($photo));

            $data['email'] = $request->email;
            $data['name'] = $request->nama;
            $data['password'] = Hash::make($request->password);
            $data['image'] = $fileName;
            User::create($data);
            
            return redirect()->route('index');
            
    }
    public function edit(Request $request,$id){
        $data = User::find($id);
        return view('edit',compact('data'));
    }
    public function detail(Request $request,$id){
        $data = User::find($id);
        return view('detail',compact('data'));
    }

    public function update(Request $request, $id){ 

       
        $validator =Validator::make($request->all(),[
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'nullable',
        ]);
        // ket: kalau validasi nya gagal / ada yang kurang di validasinya maka akan
        // balik lagi ke halaman sebelumnya dengan apa yang dia input 
         
        if($validator->fails()) return redirect()->back()->withInput()->withError($validator);

        $find = User::find($id);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        
        if($request->password){

            $data['password'] = Hash::make($request->password);
        }
        $photo = $request->file('photo');
        // dd($photo);
        // jikalau ada photonya maka dijalankan dibawah ini klo gak ada maka di lewat
        if($photo){
            $fileName = date('Y-m-d').rand(100,999) . "." . $photo->getClientOriginalExtension();
            $path = 'photo-user/'.$fileName;
            // jikalau photonya diganti maka photo yanglama terhapus
            if($find->image){
                Storage::disk('public')->delete('photo-user/' . $find->image);
            }
            Storage::disk('public')->put($path,file_get_contents($photo));

            $data['image'] = $fileName;
        }



        $find->update($data);

        return redirect()->route('index');
    }

    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){

            // untuk supaya langsung terhapus dari database meskipun di database ada system soft delete (delete_at)
            // $data->forceDelete();

            $data->delete();
        }
        // Alert::success('Success','Anda berhasil menghapus');
        return redirect()->route('index');
    }

}
