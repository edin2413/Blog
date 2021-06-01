<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ValidacionMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::getMenu();
        #return view('theme.back.menu.index');
        return view('theme.back.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.menu.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionMenu $request)
    {
        #dd($request->all());
        $validado = $request->validated();
        #dd($validado);
        Menu::create($validado);
        return redirect()->route('menu.crear')->with('mensaje', 'Menu guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Menu::findOrFail($id);
        return view('theme.back.menu.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionMenu $request, $id)
    {
        Menu::findOrFail($id)->update($request->validated());
        return redirect()->route('menu')->with('mensaje', 'Menu actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Menu::destroy($id);
        return redirect()->route('menu')->with('mensaje', 'Menu eliminado con exito');
    }
}
