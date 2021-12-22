<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Automovil;
use App\Models\Blog;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;



class UsuarioController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:see-user|create-user|edit-user|delete-user', ['only' => ['index']]);
         $this->middleware('permission:create-user', ['only' => ['create','store']]);
         $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        //Sin paginación
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */

        //Con paginación
        $plate = $request->get('buscar');

        // $usuarios = User::join('automovil', 'users.id', '=', 'automovil.id_user')
        //     ->select('users.*', 'automovil.*')
        //     ->where('automovil.plate', 'like', "%$plate%")
        //     ->paginate(5);

    $usuarios = User::where('plate','like',"%$plate%") 
    ->join('automovil', 'users.id', '=', 'automovil.id_user')
    ->select('users.*','automovil.plate', 'automovil.make', 'automovil.vin','automovil.model','automovil.color', 'automovil.year')
    ->orderBy('automovil.plate')->paginate(5);
        
        //$usuarios = User::paginate(5);
        //return $usuarios;
        return view('usuarios.index',compact('usuarios'));
        

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'plate' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'vin' => 'required',
            'model' => 'required',
            'make' => 'required',
            'color' => 'required',
            'year' => 'required',
            'roles' => 'required'
            
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = new User();
        $user->name = $input['name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        //$user->password = $input['confirm-password'];
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->city = $input['city'];
        $user->state = $input['state'];
        $user->zip_code = $input['zip_code'];
        $user->save();
        //
        $user->assignRole($request->input('roles'));

        $auto = new Automovil();
        $auto->vin = $input['vin'];
        $auto->plate = $input['plate'];
        $auto->model = $input['model'];
        $auto->make = $input['make'];
        $auto->color = $input['color'];
        $auto->year = $input['year'];
        $auto->id_user = $user->id;
        $auto->save();
        // return [$auto, $user] ; 

        //return $input;

        //$user = User::create($input);
    
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::join('automovil', 'users.id', '=', 'automovil.id_user')
        ->select('users.*', 'automovil.plate', 'automovil.make', 'automovil.vin', 'automovil.model', 'automovil.color','automovil.year', 'automovil.id as id_auto')
        ->find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        //return $user;
        return view('usuarios.editar',compact('user','roles','userRole'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'plate' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'vin' => 'required',
            'model' => 'required',
            'make' => 'required',
            'color' => 'required',
            'year' => 'required',
            'roles' => 'required'
        ]);
    
        $input['name'] = $request->name;
        $input['last_name'] = $request->last_name;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        $input['city'] = $request->city;
        $input['state'] = $request->state;
        $input['zip_code'] = $request->zip_code;
        $input['roles'] = $request->roles;

        $autoinput['plate'] = $request->plate;
        $autoinput['vin'] = $request->vin;
        $autoinput['model'] = $request->model;
        $autoinput['make'] = $request->make;
        $autoinput['color'] = $request->color;
        $autoinput['year'] = $request->year;

       
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $div = explode("-", $id);
        $user = User::find($div[0]);
        $auto = automovil::find($div[1]);
        // $blog = Blog::select('blogs.*')->where('id_plate', $auto->plate )->get();
        // $service = Blog::where('id_plate',$auto->plate);
        //return $blog;
        // $serviceinput['titulo'] = $blog->titulo;
        // $serviceinput['contenido'] = $blog->contenido;
        // $serviceinput['image'] = $blog->image;
        // $serviceinput['id_plate'] = $request->plate;
       

        $user->update($input);
        // $blog->update($serviceinput);
        $auto->update($autoinput);
        

        // return $input;
        // $user = User::find($id);
        // $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $div = explode("-", $id);
        // return $div;
        blog::where('id_plate',$div[1])->delete();
        automovil::where('plate',$div[1])->where('id_user',$div[0])->delete();
        User::find($id)->delete();
        
        return redirect()->route('usuarios.index');
    }
}

