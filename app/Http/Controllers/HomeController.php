<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTimeImmutable;
use Ddeboer\Imap\Server;
use Illuminate\Http\Request;
use App;
use Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //Страница Home
    public function index(Request $request)
    {
        //Выбор taskov из базы
        $tasksQuery = App\TaskIt::query();
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();
        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел редактирования
    public function edit()
    {
        $objects = App\ObjectIt::all();
        return view('home.edit', compact('objects'));
    }

    //Раздел кабельный журнал
    public function cableJournal()
    {
        return view('home.cableJournal');
    }

    //Раздел Баги
    public function bagiIT()
    {
        $bags = App\Bag::all();
        return view('home.bagi', compact('bags'));
    }

    //Добавление багов
    public function bagsAdd(Request $request)
    {
        $bags = new \App\Bag;
        $bags->name = $request->name;
        $bags->save();

        return redirect('/home/bagi');
    }

    //Добавление комментариев к заявке
    public function commentAdd(Request $request)
    {
        $comment = new \App\Comment;
        $comment->body = $request->body;
        $comment->task_it_id = $request->task_it_id;
        $comment->user_id = $request->user_id;
        $comment->status = "Комментарий";
        $comment->save();

        return redirect('/home');
    }

    //Раздел выполненных заявок
    public function TasksItCompleted(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('status', 'Completed');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел заявок в процессе
    public function TasksItIntheprocess(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('status', 'InTheProcess');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел не выполненых заявок
    public function TasksItNotcompleted(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('status', 'NotCompleted');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел мои заявки
    public function MyTasksIndex(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('responsible', Auth::user()->name);
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел мои заявки со статусом выполнены
    public function MyTasksItCompleted(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('responsible', Auth::user()->name)->where('status', 'Completed');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел мои заявки со статусом в процессе
    public function MyTasksItIntheprocess(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('responsible', Auth::user()->name)->where('status', 'InTheProcess');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }

        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Раздел мои заявки со статусом не выполнены
    public function MyTasksItNotcompleted(Request $request)
    {
        $tasksQuery = App\TaskIt::query()->where('responsible', Auth::user()->name)->where('status', 'NotCompleted');
        if ($request->filled('category')) {
            if ($request->category == 'All') {
                $tasksQuery->where('category', '!=', NULL);
            } else {
                $tasksQuery->where('category', $request->category);
            }
        }
        $tasks = $tasksQuery->orderByDesc('id')->paginate(40);
        $objects = App\ObjectIt::all();
        $objects_to = App\Object_to::all();
        $category_it_task = App\CategoryTaskIt::all();

        return view('home', compact('tasks', 'objects', 'objects_to', 'category_it_task'));
    }

    //Изменение статуса заявки на выаолненно и отправка письма о завершении заявки
    public function tasksItStatus(Request $request)
    {
        $tasks = App\TaskIt::find($request->id);
        $tasks->status = $request->status;
        $tasks->responsible = $request->responsible;
        $tasks->save();
        $email = $tasks->email;
        $id = $tasks->id;
        if ($request->status == 'Completed') {
            Mail::to($email)->send(new App\Mail\MailCalssYes($id));
        }

        return redirect('/home');
    }

    //Изменение статуса заявки на в процессе взята в работу
    public function tasksItResponsible(Request $request)
    {
        $tasks = App\TaskIt::find($request->id);
        $tasks->responsible = $request->responsible;
        $tasks->status = 'InTheProcess';
        $tasks->save();

        return redirect('/home');
    }

    //Добавление нового объекта
    public function objectAdd(Request $request)
    {
        $object = new \App\ObjectIt;
        $object->name = $request->name;
        $object->save();

        return redirect('/home/edit');
    }

    //Добавление новой категории
    public function categoryAdd(Request $request)
    {
        $category = new \App\CategoryTaskIt();
        $category->name = $request->name;
        $category->save();

        return redirect('/home/edit');
    }

    //Добавление рассположение на объекте
    public function object_toAdd(Request $request)
    {
        $object_to = new \App\Object_to;
        $object_to->name = $request->name;
        $object_to->object_it_id = $request->object;
        $object_to->save();

        return redirect('/home/edit');
    }

    //Редактор заявки, изменение Обьекта, категории
    public function tasksItEdittaskhome(Request $request)
    {
        $tasks = App\TaskIt::find($request->id);
        $result = $request->object_to;
        $result_explode = explode('|', $result);
        $tasks->object = $result_explode[1];
        $tasks->object_to = $result_explode[0];
        $tasks->category = $request->category;
        $tasks->save();

        return redirect('/home');
    }

    //Раздел импорта заявок с почты
    public function taskItMail()
    {
        //Вводим на стройки подключение к почте
        $server = new Server('imap.server.com');
        // $connection is instance of \Ddeboer\Imap\Connection
        //Логин, пароль от почты
        $connection = $server->authenticate('user', 'password');
        $mailboxes = $connection->getMailbox('INBOX');
        $today = new DateTimeImmutable();
        //выбираем за один день
        $thirtyDaysAgo = $today->sub(new DateInterval('P1D'));
        //Получаем тело письма
        $messages = $mailboxes->getMessages(
            new \Ddeboer\Imap\Search\Date\Since($thirtyDaysAgo),
            \SORTDATE, // Sort criteria
            true // Descending order
        );
        $id_mail = App\TaskIt::pluck('id_mail')->max();
        //Перебираем письмп и добавляем их как task в базу данных
        foreach ($messages as $m) {
            $a = $m->getNumber();
            $b = $m->getFrom()->getAddress();

            //email который в бане. если он не равен то добавляем новую заявку
            if ($b != 'ganzevich.s@kandevelopment.com') {
                if ($a > $id_mail) {
                    //               echo $a;
                    $tasks = new \App\TaskIt;
                    $tasks->name = $m->getFrom()->getName();
                    $tasks->email = $m->getFrom()->getAddress();
                    $tasks->theme = $m->getSubject();
                    $tasks->category = 'Заявка с почты';
                    $tasks->status = 'NotCompleted';
                    $tasks->text = $m->getBodyText();
                    $tasks->id_mail = $m->getNumber();
                    $tasks->save();

                    $email = $m->getFrom()->getAddress();
                    $id = $tasks->id;
                    //После добавлении заявки отправляем письмо пользователю о добавлении заявки в очередь и его ID
                    Mail::to($email)->send(new App\Mail\MailCalss($id));
                }
            }
        }

        return view('home.mail', compact('messages'));
    }


    public function addTaskMail(Request $request)
    {
        $tasks = new \App\TaskIt;
        $tasks->name = $request->name;
        $tasks->email = $request->email;
        $tasks->theme = $request->theme;
        $tasks->category = 'Заявка с почты';
        $tasks->status = 'NotCompleted';
        $tasks->text = $request->text;
        $tasks->id_mail = $request->id_mail;
        $tasks->save();

        return redirect('/home/mail');
    }

    //Ответ пользователю, it-специалистом и добавление в коментарии
    public function mailotvetAdd(Request $request)
    {
        $comment = new \App\Comment;
        $comment->body = $request->body;
        $comment->task_it_id = $request->task_it_id;
        $comment->user_id = $request->user_id;
        $comment->status = "Ответ пользователю";
        $email = $request->email;
        $id = $request->task_it_id;
        $body = $request->body;
        $phone = $request->phone;
        Mail::to($email)->send(new App\Mail\MailOtvet($id, $body, $phone));
        $comment->save();

        $tasks = App\TaskIt::find($request->task_it_id);
        $tasks->status = 'InTheProcess';
        $tasks->responsible = $request->user_id;
        $tasks->save();

        return redirect('/home');
    }


}
