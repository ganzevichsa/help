<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    //Начальная страница быстрой заявки - добавление и отправка письма пользователю
    public function taskItAdd(Request $request)
    {
        //Проверка введенных данных
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $tasks = new \App\TaskIt;
        $tasks->name = $request->name;
        $tasks->contact = $request->contact;
        $tasks->email = $request->email;
        $result = $request->object_to;
        $result_explode = explode('|', $result);
        $tasks->object = $result_explode[1];
        $tasks->object_to = $result_explode[0];
        $tasks->category = 'Быстрая заявка';
        $tasks->status = 'NotCompleted';
        $tasks->text = $request->text;
        $tasks->save();
        $email = $request->email;
        $id = $tasks->id;
        Mail::to($email)->send(new App\Mail\MailCalss($id));

        return redirect('/');
    }

    //Статус заявки
    public function statusZayavkiYes(Request $request)
    {
        $task = App\TaskIt::find($request->id);
        if ($task === null){
            return view('statusZayavki');
        }
        else
            return view('statusZayavkiYes',compact('task'));
    }


    public function statusTaskIt($id)
    {

        $task = App\TaskIt::find($id);
        return view('statusZayavkiYes',compact('task'));
    }

    //Добавление комментариев пользователем в свою заявку
    public function taskGuestCommentAdd(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
//
        ]);
        $comment = new \App\Comment;
        $comment->body = $request->body;
        $comment->task_it_id = $request->task_it_id;
        $comment->user_id = $request->user_id;
        $comment->status = "Комментарий пользователя";
        $comment->save();
        $task = App\TaskIt::find($request->task_it_id);
        $moycomment = $request->body;

        return view('statusZayavkiYesTo',compact('task','moycomment'));
    }

}
