<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BpadsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSupportController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\CreadorContenidoController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\FanartController;
use App\Http\Controllers\FichasController;
use App\Http\Controllers\MochilaController;
use App\Http\Controllers\PerfilUserController;
use App\Http\Controllers\RankingsController;
use App\Http\Controllers\RecoverPassword;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\WebContactoController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\Rankings\RingController;
use App\Http\Controllers\Rankings\CaminoNinjaController;
use App\Http\Controllers\Rankings\BesosController;
use App\Http\Controllers\Rankings\BebidasController;
use App\Http\Controllers\Rankings\FloresController;
use App\Http\Controllers\Rankings\UppercutsController;
use App\Http\Controllers\Rankings\CocosController;
use App\Http\Controllers\Rankings\CocosLocosController;
use App\Http\Controllers\Rankings\SenderoOcultoController;
use App\Http\Controllers\Rankings\ForbesController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Tienda\TiendaController;

//Home 
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'autentification'])->name('login');

//Recuperar contraseña
Route::get('/recover-password', [RecoverPassword::class, 'index'])
    ->name('recover.password');
Route::post('/recover-password/search-user', [RecoverPassword::class, 'reciveEmail'])
    ->name('send.new.password');
Route::get('/recover-password/search-user', [RecoverPassword::class, 'cambiarPassword']);

Route::post('recover-password/validate', [RecoverPassword::class, 'cambiarPasswordSave'])
    ->name('recover.password.validate');

//Registro
Route::get('/registry', [RegistroController::class, 'index'])
    ->name('registry');
Route::post('/registry/account', [RegistroController::class, 'create'])
    ->name('registry.account');

//Descargar Yocomania Launcher
Route::get('/yocomania-studio', function () {
    return view('launcher');
})->name('download.launcher');

//Administrator Login
Route::get('/web-admin', [AdminLoginController::class, 'index']);

Route::post('/admin-login', [AdminLoginController::class, 'login'])
    ->name('admin.login');
//Administrator Dashboard
Route::get('/admin-dashboard', [AdminDashboardController::class, 'index']);

Route::post('/admin-logout', [AdminDashboardController::class, 'salir'])
    ->name('admin.logout');
//Contacto Home
Route::post('/home/contacto', [WebContactoController::class, 'addContacto'])
    ->name('home.contacto');



//User Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/me', [DashboardController::class, 'index'])
        ->name('me');
    Route::post('/me/{usuario}/salir', [DashboardController::class, 'logout'])->name('logout');
    ///BPads
    Route::post('/cargarBpads', [BpadsController::class, 'index'])
        ->name('obtener.bpads');
    Route::get('/updateActivityPad', [BpadsController::class, 'activity'])
        ->name('update.activity.pad');
    Route::post('/send/message', [BpadsController::class, 'send'])
        ->name('inser.chat');
    Route::post('/user/fetch/chat', [BpadsController::class, 'fetchChat'])
        ->name('fetch.chat.history');
    Route::post('/avatar/pad', [BpadsController::class, 'avatarPad'])
        ->name('obtener.avatar.pad');

    Route::get('/buscarYocomaniaco', [BpadsController::class, 'buscarYocomaniaco'])
        ->name('buscar.yocomaniaco');

    Route::post('/user/accion/perfil', [BpadsController::class, 'amigosManager'])
        ->name('obtener.accion.perfil');

    //Buscar amigos section
    Route::post('/user/amigos/recomendaciones', [BpadsController::class, 'recomendado'])
        ->name('obtener.recomendaciones.amigos');

    Route::get('/user/amigos/buscar', [BpadsController::class, 'buscarAmigo'])
        ->name('buscar.yocomaniaco.tag');

    Route::post('/user/amigos/buscar', [BpadsController::class, 'buscarTodosAmigos'])
        ->name('buscar.yocomaniacos.todos');

    Route::get('user/paginate/friends', [BpadsController::class, 'paginate_search']);

    //Solicitudes de amistad
    Route::post('/user/solicitudes/amistad', [BpadsController::class, 'obtenerSolicitudes'])
        ->name('user.cargar.solicitudes');

    Route::post('/user/aceptar/amistad', [BpadsController::class, 'aceptarSolicitud'])
        ->name('user.aceptar.solicitud');
    Route::post('/user/denegar/amistad', [BpadsController::class, 'denegarSolicitud'])
        ->name('user.denegar.solicitud');
    //Soporte de usuarios
    Route::post('/me/support/send', [SupportController::class, 'send'])
        ->name('user.send.support');
    Route::get('/me/support/messages', [SupportController::class, 'get'])
        ->name('obtener.user.support.message');
    Route::delete('/user/support/delete/{support?}', [SupportController::class, 'delete'])
        ->name('user.support.delete');

    //Ajustes
    Route::post('/change-password', [AjustesController::class, 'cambiarPassword'])
        ->name('change.passoword');
    Route::post('/change-security', [AjustesController::class, 'cambiarClaveSeguridad'])
        ->name('change.security');
    Route::post('/change-email', [AjustesController::class, 'cambiarEmail'])
        ->name('change.email');

    //Armario Fichas
    Route::post('/change-ficha', [FichasController::class, 'change'])
        ->name('change.ficha');

    //Perfil Usuario Visitar
    Route::get('/perfil/{usuario}', [PerfilUserController::class, 'perfil'])
        ->name('look.user.profile');

    //Creador de contenido 
    Route::post('/perfil/creator/screenshot', [CreadorContenidoController::class, 'createScreenshot'])
        ->name('perfil.crear.screenshot');
    Route::post('/perfil/crear/fanart', [CreadorContenidoController::class, 'createFanart'])
        ->name('perfil.crear.fanart');
    Route::post('/perfil/crear/youtube', [CreadorContenidoController::class, 'createYoutube'])
        ->name('perfil.crear.youtube');

    //Mochila Perfil usuario
    Route::post('/perfil/mochila/user', [MochilaController::class, 'load'])
        ->name('obtener.mochila');
    Route::get('mochila/paginate', [MochilaController::class, 'paginate_search']);
    //Venta Objetos
    Route::post('/perfil/mochila/sell', [MochilaController::class, 'sell'])
        ->name('vender.objeto');
    Route::get('/perfil/cargar/ventas', [MochilaController::class, 'ventas'])
        ->name('cargar.user.ventas');
    Route::post('/perfil/delete/sell', [MochilaController::class, 'deleteSell'])
        ->name('eliminar.user.venta');



    //Tienda de objetos
    Route::get('/shop', [TiendaController::class, 'show'])
        ->name('show.tienda');

    //Rankings ************************************************************************************************
    //Ranking Ring
    Route::get('ranking/ring', [RankingsController::class, 'ringRanking'])
        ->name('ranking.ring');
    Route::get('ranking/ring/semanal', [RingController::class, 'ringSemanalGolden'])
        ->name('ranking.ring.semanal');
    Route::get('ranking/ring/semanal/silver', [RingController::class, 'ringSemanalSilver'])
        ->name('ranking.ring.semanal.silver');
    Route::get('ranking/ring/global', [RingController::class, 'ringGlobal'])
        ->name('ranking.ring.global');
    Route::get('/ranking/ring/semanal/tops', [RingController::class, 'ringSemanalGoldenTops'])
        ->name('ranking.ring.semanal.tops');
    Route::get('/ranking/ring/semanal/tops/silver', [RingController::class, 'ringSemanalSilverTops'])
        ->name('ranking.ring.semanal.tops.silver');
    //Ranking Sendero
    Route::get('ranking/sendero-oculto', [RankingsController::class, 'senderoRanking'])
        ->name('ranking.sendero');
    Route::get('/ranking/sendero-oculto/global', [SenderoOcultoController::class, 'senderoOcultoGlobal'])
        ->name('ranking.sendero.global');
    Route::get('/ranking/sendero-oculto/semanal', [SenderoOcultoController::class, 'senderoOcultoSemanal'])
        ->name('ranking.sendero.semanal');
    Route::get('/ranking/sendero/semanal/tops', [SenderoOcultoController::class, 'senderoSemanalTops'])
        ->name('ranking.sendero.semanal.tops');
    //Ranking Cocos Locos
    Route::get('ranking/cocos-locos', [RankingsController::class, 'cocosLocosRanking'])
        ->name('ranking.cocos-locos');
    Route::get('/ranking/cocos-locos/global', [CocosLocosController::class, 'cocosLocosGlobal'])
        ->name('ranking.cocos-locos.global');
    Route::get('ranking/cocos-locos/semanal', [CocosLocosController::class, 'cocosLocosSemanalGolden'])
        ->name('ranking.cocos-locos.semanal');
    Route::get('/ranking/cocos-locos/semanal/tops', [CocosLocosController::class, 'cocosLocosSemanalGoldenTops'])
        ->name('ranking.cocos-locos.semanal.tops');
    Route::get('ranking/cocos-locos/semanal/silver', [CocosLocosController::class, 'cocosLocosSemanalSilver'])
        ->name('ranking.cocos-locos.semanal.silver');
    Route::get('/ranking/cocos-locos/semanal/tops/silver', [CocosLocosController::class, 'cocosLocosSemanalSilverTops'])
        ->name('ranking.cocos-locos.semanal.tops.silver');
    //Ranking Camino Ninja
    Route::get('ranking/camino-ninja', [RankingsController::class, 'caminoNinjaRanking'])
        ->name('ranking.camino-ninja');
    Route::get('/ranking/camino-ninja/global', [CaminoNinjaController::class, 'caminoNinjaGlobal'])
        ->name('ranking.ninja.global');
    ///Ranking Besos
    Route::get('ranking/besos', [RankingsController::class, 'besosRanking'])
        ->name('ranking.besos');
    Route::get('/ranking/besos/enviados', [BesosController::class, 'besosEnviadosRanking'])
        ->name('ranking.besos.enaviados');
    Route::get('/ranking/besos/recibidos', [BesosController::class, 'besosRecibidosRanking'])
        ->name('ranking.besos.recibidos');
    //Ranking Bebidas
    Route::get('ranking/bebidas', [RankingsController::class, 'bebidasRanking'])
        ->name('ranking.bebidas');
    Route::get('/ranking/bebidas/enviados', [BebidasController::class, 'bebidasEnviadosRanking'])
        ->name('ranking.bebidas.enaviados');
    Route::get('/ranking/bebidas/recibidos', [BebidasController::class, 'bebidasRecibidosRanking'])
        ->name('ranking.bebidas.recibidos');
    //Ranking Flores
    Route::get('ranking/flores', [RankingsController::class, 'floresRanking'])
        ->name('ranking.flores');
    Route::get('/ranking/flores/enviados', [FloresController::class, 'floresEnviadosRanking'])
        ->name('ranking.flores.enaviados');
    Route::get('/ranking/flores/recibidos', [FloresController::class, 'floresRecibidosRanking'])
        ->name('ranking.flores.recibidos');
    //Ranking Uppercuts
    Route::get('ranking/uppercuts', [RankingsController::class, 'uppercutsRanking'])
        ->name('ranking.uppercuts');
    Route::get('/ranking/uppercuts/enviados', [UppercutsController::class, 'uppercutsEnviadosRanking'])
        ->name('ranking.uppercuts.enaviados');
    Route::get('/ranking/uppercuts/semanal', [UppercutsController::class, 'uppercutsSemanalRanking'])
        ->name('ranking.uppercuts.semanal');
    Route::get('/ranking/upperscuts/semanal/tops', [UppercutsController::class, 'uppercutsSemanalTops'])
        ->name('ranking.uppercuts.semanal.tops');
    //Ranking Cocos
    Route::get('ranking/cocos', [RankingsController::class, 'cocosRanking'])
        ->name('ranking.cocos');
    Route::get('/ranking/cocos/enviados', [CocosController::class, 'cocosEnviadosRanking'])
        ->name('ranking.cocos.enaviados');
    // Ranking Forbes
    Route::get('ranking/forbes', [RankingsController::class, 'forbesRanking'])
        ->name('ranking.forbes');
    Route::get('/ranking/forbes/global', [ForbesController::class, 'forbesGlobal'])
        ->name('ranking.forbes.global');
    //Administrator Dashboard Content
    //Eventos
    Route::post('/admin/event-create', [EventosController::class, 'create'])
        ->name('create.event');
    Route::get('/admin/event-search', [EventosController::class, 'search'])
        ->name('eventos.search');
    Route::post('/admin/event-delete', [EventosController::class, 'delete'])
        ->name('eventos.delete');
    //Screens
    Route::post('/admin/scree-create', [ScreenController::class, 'create'])
        ->name('create.screenshot');
    Route::get('/admin/creador/screen', [ScreenController::class, 'getCreatorContent'])
        ->name('solicitud.screenshots');
    Route::get('/admin/creador/create/screen', [ScreenController::class, 'addCreatorContent'])
        ->name('aceptar.screenshot.creator');
    Route::get('/admin/creador/delete/screen', [ScreenController::class, 'deleteCreatorContent'])
        ->name('eliminar.screenshot.creator');
    //Contenido YouTube
    Route::post('/admin/youtube-create', [YoutubeController::class, 'create'])
        ->name('create.youtube');
    Route::get('/admin/creador/youtube', [YoutubeController::class, 'getCreatorContent'])
        ->name('solicitud.youtube');
    Route::get('/admin/creador/create/youtube', [YoutubeController::class, 'addCreatorContent'])
        ->name('aceptar.youtube.creator');
    Route::get('/admin/creador/delete/youtube', [YoutubeController::class, 'deleteCreatorContent'])
        ->name('eliminar.youtube.creator');
    //Fanart
    Route::post('/admin/fanart-create', [FanartController::class, 'create'])
        ->name('create.fanart');
    Route::get('/admin/creador/fanart', [FanartController::class, 'getCreatorContent'])
        ->name('solicitud.fanart');
    Route::get('/admin/creador/create/fanart', [FanartController::class, 'addCreatorContent'])
        ->name('aceptar.fanart.creator');
    Route::get('/admin/creador/delete/fanart', [FanartController::class, 'deleteCreatorContent'])
        ->name('eliminar.fanart.creator');
    //Support Messages
    Route::get('/admin/support', [AdminSupportController::class, 'get'])
        ->name('admin.support');
    Route::post('/admin/support/one', [AdminSupportController::class, 'sendOne'])
        ->name('admin.support.send.one');
    Route::delete('/admin/support/delete/{support?}', [AdminSupportController::class, 'delete'])
        ->name('admin.support.delete');
    Route::post('/admin/support/send', [AdminSupportController::class, 'send'])
        ->name('admin.support.send');
});
