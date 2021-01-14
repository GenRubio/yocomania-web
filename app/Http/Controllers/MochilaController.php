<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenderObjetoRequest;
use App\Models\ObjetosComprado;
use App\Models\WebObjetosVenta;
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
                $venta = new WebObjetosVenta();
                $venta->objeto_id = $request->get('objetoId');
                $venta->compra_id = $request->get('compraId');
                $venta->usuario_id = auth()->user()->id;
                $venta->oro = $request->get('ventaOro');
                $venta->save();
                
            } else if ($tipo == "plata") {
                $venta = new WebObjetosVenta();
                $venta->objeto_id = $request->get('objetoId');
                $venta->compra_id = $request->get('compraId');
                $venta->usuario_id = auth()->user()->id;
                $venta->plata = $request->get('ventaOro');
                $venta->save();
            }
            ObjetosComprado::where('id', $request->get('compraId'))
                ->where('objeto_id', $request->get('objetoId'))
                ->where('usuario_id', auth()->user()->id)
                ->where('active', 1)
                ->update(['active' => 0, 'posX' => 0, 'posY' => 0, 'espacio_ocupado' => "", 'sala_id' => 0]);
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
    public function ventas()
    {
        $objetos = DB::table('web_objetos_ventas')
            ->join('objetos', 'objetos.id', '=', 'web_objetos_ventas.objeto_id')
            ->select('web_objetos_ventas.id','web_objetos_ventas.compra_id','web_objetos_ventas.usuario_id', 'web_objetos_ventas.objeto_id', 'web_objetos_ventas.oro', 'web_objetos_ventas.plata', 'objetos.swf', 'objetos.img', 'objetos.titulo')
            ->where('usuario_id', auth()->user()->id)
            ->paginate(12);

        $content = view('components.perfilUsuario.mochila._ventas', compact('objetos'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function deleteSell(Request $request){
        $webVentaId = $request->get('webVentaId');
        $compraId = $request->get('compraId');
        $objetoId = $request->get('objetoId');
        $userId = $request->get('userId');

        WebObjetosVenta::where('objeto_id', $objetoId)
        ->where('compra_id', $compraId)
        ->where('usuario_id', $userId)
        ->where('id', $webVentaId)
        ->delete();

        ObjetosComprado::where('objeto_id', $objetoId)
        ->where('id', $compraId)
        ->where('usuario_id', $userId)
        ->where('active', 0)
        ->update(['active' => 1]);

        return response()->json([
            'content' => "La venta ha sido cancelada.",
        ], Response::HTTP_CREATED);
    }
}
