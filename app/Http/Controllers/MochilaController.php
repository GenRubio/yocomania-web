<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenderObjetoRequest;
use App\Models\ObjetosComprado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MochilaController extends Controller
{
    public function load()
    {
        $total = DB::table('objetos_comprados')
            ->join('objetos', 'objeto_id', '=', 'objetos.id')
            ->select(DB::raw('count(objetos_comprados.objeto_id) as cantidad'), 'objetos_comprados.id', 'objetos_comprados.objeto_id', 'objetos_comprados.usuario_id', 'objetos.titulo', 'objetos.descripcion', 'objetos.swf', 'objetos.categoria', 'objetos.precio_oro', 'objetos.precio_plata', 'objetos.tipo_rare', 'objetos.img')
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 1)
            ->groupBy('objeto_id')
            ->get();

        $objetos = DB::table('objetos_comprados')
            ->join('objetos', 'objeto_id', '=', 'objetos.id')
            ->select(DB::raw('count(objetos_comprados.objeto_id) as cantidad'), 'objetos_comprados.id', 'objetos_comprados.objeto_id', 'objetos_comprados.usuario_id', 'objetos.titulo', 'objetos.descripcion', 'objetos.swf', 'objetos.categoria', 'objetos.precio_oro', 'objetos.precio_plata', 'objetos.tipo_rare', 'objetos.img')
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 1)
            ->groupBy('objeto_id')
            ->paginate(12);

        $content = view('components.perfilUsuario._mochila', compact('objetos', 'total'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function sell(VenderObjetoRequest $request)
    {
        $tipo = $request->get('creditos');

        $objeto = ObjetosComprado::where('id', $request->get('compraId'))
            ->where('objeto_id', $request->get('objetoId'))
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 1)
            ->get();

        if ($objeto != null) {
            if ($tipo == "oro") {
                //Consulta para añadir el objeto en la tienda
            } else if ($tipo == "plata") {
                //Consulta para añadir el objeto en la tienda
            }
            ObjetosComprado::where('id', $request->get('compraId'))
                ->where('objeto_id', $request->get('objetoId'))
                ->where('usuario_id', auth()->user()->id)
                ->where('active', 1)
                ->update(['active' => 0]);
        }

        return response()->json([
            'result' => "Objeto se ha publicado correctamente.",
        ], Response::HTTP_CREATED);
    }
    public function paginate_search()
    {
        $total = DB::table('objetos_comprados')
            ->join('objetos', 'objeto_id', '=', 'objetos.id')
            ->select(DB::raw('count(objetos_comprados.objeto_id) as cantidad'), 'objetos_comprados.id', 'objetos_comprados.objeto_id', 'objetos_comprados.usuario_id', 'objetos.titulo', 'objetos.descripcion', 'objetos.swf', 'objetos.categoria', 'objetos.precio_oro', 'objetos.precio_plata', 'objetos.tipo_rare', 'objetos.img')
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 1)
            ->groupBy('objeto_id')
            ->get();

        $objetos = DB::table('objetos_comprados')
            ->join('objetos', 'objeto_id', '=', 'objetos.id')
            ->select(DB::raw('count(objetos_comprados.objeto_id) as cantidad'), 'objetos_comprados.id', 'objetos_comprados.objeto_id', 'objetos_comprados.usuario_id', 'objetos.titulo', 'objetos.descripcion', 'objetos.swf', 'objetos.categoria', 'objetos.precio_oro', 'objetos.precio_plata', 'objetos.tipo_rare', 'objetos.img')
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 1)
            ->groupBy('objeto_id')
            ->paginate(12);

        $content = view('components.perfilUsuario._mochila', compact('objetos', 'total'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
