<?php

namespace LaraDex\Http\Controllers;

use Illuminate\Http\Request;

Use LaraDex\Trainer;
class TrainnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = Trainer::all();//consulta todos los entrenadores registrados
        return view('trainers.index',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();//para obtener el nombre del archivo
            $file->move(public_path().'/images', $name);//muevo el archivo y creo la carpeta con su nombre correspondiente
           
        }

        $trainer = new Trainer();
        $trainer->name = $request -> input('name');
        $trainer->avatar = $name;
        // $trainer->slug = "cambia_nombre";
        $trainer->save();//guarda el valor del input de entrada
        return 'Saved';
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        // $trainer = Trainer::where('slug','=',$slug)->firstOrFail();//lanza una exception si no encuentra el modelo a buscar
        // $trainer = Trainer::find($id); //permite buscar por el id
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        return view('trainers.edit',compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        // $trainer->fill($request->all());//se encarga de actualizar la informacion por nosotros y todo lo que venga en ese request
        $trainer->fill($request->except('avatar'));//except:le digo actualiza todo menos este campo
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();//para obtener el nombre del archivo
            $trainer->avatar = $name;//le paso el nuevo path a mi campo avatar de la bd
            $file->move(public_path().'/images', $name);//muevo el archivo y creo la carpeta con su nombre correspondiente           
        }
        $trainer->save();//guarda los cambios
        return 'update';
    }    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
