<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * Devuelve la vista messages.index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Si el usuario es admin, muestra todos los mensajes
        if (auth()->user()->role == "admin") {
            //Obtiene todos los mensajes ordenados por fecha de creación descendente y los pagina de 5 en 5
            $messages = Message::orderBy('created_at', 'desc')->simplePaginate(5);
            //Devuelve la vista messages.index con los mensajes obtenidos
            return view('messages.index', compact('messages'));
        } else {
            //Si no es admin, redirige a la vista index
            return redirect()->route('index');
        }
    }

    /**
     * Devuelve la vista messages.create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Crea un nuevo mensaje
     *
     * @param  App\Http\Requests\MessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        //Crea un nuevo mensaje
        $message = new Message();
        //Asigna los valores del formulario al mensaje
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->text = $request->text;

        //Guarda el mensaje en la base de datos
        $message->save();

        //Redirige a la vista messages.create con un mensaje de éxito
        return redirect()->route('messages.create')->with('success', 'Mensaje enviado correctamente');
    }

    /**
     * Devuelve la vista messages.show
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //Si el usuario es admin, muestra el mensaje
        if (auth()->user()->role == "admin") {
            //Marca el mensaje como leído
            $message->readed = true;
            //Guarda el mensaje en la base de datos
            $message->save();
            //Devuelve la vista messages.show con el mensaje obtenido
            return view('messages.show', compact('message'));
        } else {
            //Si no es admin, redirige a la vista index
            return redirect()->route('index');
        }
    }

    /**
     * Devuelve la vista messages.edit
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //No se puede editar un mensaje
    }

    /**
     * Actualiza el mensaje especificado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //No se puede editar un mensaje
    }

    /**
     * Elimina el mensaje especificado
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //Si el usuario es admin, elimina el mensaje
        if (auth()->user()->role == "admin") {
            //Elimina el mensaje
            $message->delete();
            //Redirige a la vista messages.index con un mensaje de éxito
            return redirect()->route('messages.index')->with('success', 'Mensaje eliminado correctamente');
        } else {
            //Si no es admin, redirige a la vista index
            return redirect()->route('index');
        }
    }
}
