<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;
use App\Models\Relacion;
use App\Models\User;

class BlogController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:see-service|create-service|edit-service|delete-service')->only('index');
         $this->middleware('permission:create-service', ['only' => ['create','store']]);
         $this->middleware('permission:edit-service', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-service', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $plate = $request->get('buscar');

        $blogs = Blog::where('id_plate','like',"%$plate%")->paginate(5);
        
         //Con paginación
         
         return view('blogs.index',compact('blogs'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $blogs->links() !!}    
    }
    
    public function downloadplaca(Request $request){
       $plates = $request->get('plate');

       //$id_user = DB::table('automovil')->where('plate', $input['id_plate'])->get();

        $sql = "SELECT * FROM blogs b,automovil a inner join users u on a.id_user = u.id WHERE a.plate = '".$plates."';";
       
       //$blogs = Blog::where('id_plate','like',"%$plates%");

       $blogs = DB::select($sql);

       //return $blogs;
        view()->share('blogs.pdf',$blogs);
        $pdf = PDF::loadView('blogs.pdf-plate', compact('blogs'));
       
        return $pdf->setPaper('a4', 'landscape')->stream('reporte-placa.pdf');
   }

    public function downloadPDF(){
        
        $sql = 'SELECT * FROM automovil a, blogs b, users u WHERE a.id_user=u.id AND b.id_plate = a.plate;';
       
        
        $blogs = DB::select($sql);
        view()->share('blogs.pdf',$blogs);
        $pdf = PDF::loadView('blogs.pdf', compact('blogs'));
        return $pdf->setPaper('a4', 'landscape')->stream('reporte.pdf');
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_plate' => 'required',
            'titulo' => 'required',
            'contenido' => 'required',
            'image' => 'required|image|mimes:png,jpg,PNG,JPG|max:1024'
        ]);
        $producto = new Blog();
        $input = $request->all();
    
        if($imagen = $request->file('image')){
            $rutaGuardarImagen = 'imagen/';
            $imgServ = date('YmdHis'). ".". $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImagen, $imgServ);
            $input['image'] = "$imgServ";
        }
        $id_user = DB::table('automovil')->select('id_user')->where('plate', $input['id_plate'])->get();

        $user = User::find($id_user[0]->id_user);
        
        $producto->id_plate =  $input['id_plate'];
        $producto->titulo =  $input['titulo'];
        $producto->contenido =  $input['contenido'];
        $producto->image =  $input['image'];

        //return $producto;

        Blog::createNotificationBlog($user,$producto);
        //Blog::create($producto);
        $producto->save();
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.editar',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
         request()->validate([
            'id_plate' => 'required',
            'titulo' => 'required', 
            'contenido' => 'required', 
        ]);
    
            $prod = $request->all();
    
            if($imagen = $request->file('image')){
                $rutaGuardarImagen = 'imagen/';
                $imgServ = date('YmdHis'). ".". $imagen->getClientOriginalExtension();
                $imagen->move($rutaGuardarImagen, $imgServ);
                $prod['image'] = "$imgServ";
            }else{
                unset($prod['image']);
            }
    
            $blog->update($prod);
            return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    
        return redirect()->route('blogs.index');
    }
}
