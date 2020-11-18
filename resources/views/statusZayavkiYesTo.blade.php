@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">Страница проверки Вашей заявки</h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="mb-0 table">
                                <tbody>
                                <tr>
                                <tr>
                                    <td>
                                        ID Вашей заявки
                                    </td>
                                    <td class="text-right">{{$task->id}}</td>
                                </tr>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    Статус
                                </td>
                                @if($task->status == 'Completed')
                                    <td><span class="text-right float-right badge-success">Заявка выполнена</span></td>
                                @elseif($task->status == 'InTheProcess')
                                    <td><span class="text-right float-right badge-warning">В процессе выполнения</span></td>
                                @else
                                    <td><span class="text-right float-right badge-danger">Заявка не выполнена</span></td>
                                    @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            Отвестевенный
                                        </td>
                                        <td class="text-right">{{$task->responsible}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle mr-2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                            Номер телефона отвественного
                                        </td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::open(['route' => 'taskGuest.comment.add', 'method' => 'post']) !!}
                                            {{ Form::hidden('task_it_id', $task->id) }}
                                            {!! Form::label('user_id', 'Фамилия Имя', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('user_id', $value = null, array('required' => 'required'), ['class' => 'form-control']) !!}
                                            </div>
                                            <textarea class="form-control"  required name="body" cols="50" rows="3" id="text" style="margin-top: 10px"></textarea>
                                            <input class="btn btn-sm btn-outline-secondary"  type="submit" value="Оставить комментарий" style="margin-top: 10px; margin-bottom: 10px">
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {{$moycomment}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
