@extends('layouts.appAdmin')

@section('content')
    <div class="col-sm-12" style="padding: 0">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Все заявки</h5>
            </div>
            <div class="form-group col-sm-4" style="padding-left: 10px">
                {!! Form::open(['method' => 'get']) !!}
                {!! Form::label('category', 'Категория', ['class' => 'col-sm-12 col-form-label']) !!}
                <div class="col-sm-12" style="display: flex;">
                    <select required="required" class="form-control" name="category">
                        <option value="All">Все</option>
                        @foreach ($category_it_task as $categoryItem)
                            <option value="{{ $categoryItem->name }}">- {{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                    {!! Form::submit('Выбрать', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <table class="table table-condensed" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th class="d-none d-md-table-cell">Тема</th>
                    <th>Статус</th>
                    <th class="d-none d-md-table-cell">Дата</th>
                    <th class="d-none d-md-table-cell">Ответственный</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                <tr data-toggle="collapse" data-target="#demo{{$task->id}}" class="collapsed" aria-expanded="false">
                    <td>{{$task->id}}</td>
                    <td>@if($task->name != NULL){{$task->name}}@elseif($task->email != NULL){{$task->email}}@else{{$task->contact}}@endif</td>
                    <td class="d-none d-md-table-cell">{{$task->theme}}</td>
{{--                    <td class="d-none d-md-table-cell">@if($task->contact != NULL){{$task->contact}}@else{{$task->email}}@endif</td>--}}
                    @if($task->status == 'Completed')
                        <td><span class="badge badge-success">Завершено</span><span style="display: block; width: 100%; font-size: 10px;">комментарии: {{$task->comments->count()}}</span></td>
                    @elseif($task->status == 'InTheProcess')
                        <td><span class="badge badge-warning">В процессе</span><span style="display: block; width: 100%; font-size: 10px;">комментарии: {{$task->comments->count()}}</span></td>
                    @else
                        <td><span class="badge badge-danger">Не завершено</span><span style="display: block; width: 100%; font-size: 10px;">комментарии: {{$task->comments->count()}}</span></td>
                    @endif

                    <td class="d-none d-md-table-cell">{{$task->created_at}}</td>
                    <td class="d-none d-md-table-cell">{{$task->responsible}}</td>
                </tr>
                <tr>
                    <td colspan="12" class="hiddenRow">
                        <div class="accordian-body collapse" id="demo{{$task->id}}" style="">
                            <div class="col-lg-12" style="display: flow-root; padding-left: 0; padding-right: 0; padding-top: 10px;">
                                <div class="col-sm-6" style="float: left">
                                    <div style="margin-left: 25px">
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Тема: </text> {{$task->theme}}</p>
                                        <p class="margin-0" style="padding: 0; margin: 0">{{$task->text}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Телефон: </text> {{$task->contact}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Email: </text> {{$task->email}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Обьект: </text>{{$task->object}}: {{$task->object_to}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Дата: </text>{{$task->created_at}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Ответственный: </text>{{$task->responsible}}</p>
                                        <p class="margin-0" style="margin: 0"><text style="font-weight: 600;">Категория: </text>{{$task->category}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center" style="margin: 5px;">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => 'tasksIt.status', 'method' => 'post']) !!}
                                            {{ Form::hidden('id', $task->id) }}
                                            {{ Form::hidden('status', 'Completed') }}
                                            {{ Form::hidden('responsible', Auth::user()->name) }}
                                            {!! Form::submit('Завершено', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => 'tasksIt.status', 'method' => 'post']) !!}
                                            {{ Form::hidden('id', $task->id) }}
                                            {{ Form::hidden('status', 'InTheProcess') }}
                                            {{ Form::hidden('responsible', Auth::user()->name) }}
                                            {!! Form::submit('В процессе', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => 'tasksIt.status', 'method' => 'post']) !!}
                                            {{ Form::hidden('id', $task->id) }}
                                            {{ Form::hidden('status', 'NotCompleted') }}
                                            {{ Form::hidden('responsible', '-') }}
                                            {!! Form::submit('Не завершено', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center" style="margin-left: 15px; margin-top: 10px; margin-bottom: 10px">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => 'tasksIt.responsible', 'method' => 'post']) !!}
                                            {{ Form::hidden('id', $task->id) }}
                                            {{ Form::hidden('responsible', Auth::user()->name) }}
                                            {!! Form::submit('Взять в работу', ['class' => 'btn btn-sm btn-outline-vrabotu']) !!}
                                            {!! Form::close() !!}
                                            <button class="btn btn-primary btnredak" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="padding: 0.25rem 0.5rem;font-size: 0.875rem;line-height: 1.5;border-radius: 0.2rem;">
                                                Редактор
                                            </button>
                                        </div>

                                        <div class="collapse" id="collapseExample">
                                            {!! Form::open(['route' => 'tasksIt.edittaskhome', 'method' => 'post']) !!}
                                            <div class="row form-group col-lg-12" style="margin: 0;border-top: 1px solid;">
                                                {!! Form::label('name', 'Изменить рассположение ', ['class' => 'col-sm-12 col-form-label']) !!}
                                                <div class="col-sm-12">
                                                    <select required="required" class="form-control" name="object_to">
                                                        <option value="{{$task->object_to}}">{{$task->object}}: {{$task->object_to}}</option>
                                                        @foreach ($objects as $objectItem)
                                                            <optgroup label="{{ $objectItem->name }}" style="font-size: 16px; font-weight: 600;"></optgroup>
                                                            @foreach($objectItem->object_tos as $objectItem_to)
                                                                <option value="{{ $objectItem_to->name }}|{{ $objectItem->name }}">- {{ $objectItem_to->name }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row form-group col-lg-12" style="margin-left: 0; margin-right: 0;">
                                                {!! Form::label('category', 'Изменить категорию', ['class' => 'col-sm-12 col-form-label']) !!}
                                                <div class="col-sm-12">
                                                    <select required="required" class="form-control" name="category">
                                                        <option value="{{$task->category}}">{{$task->category}}</option>
                                                        @foreach ($category_it_task as $category_it_taskItem)
                                                            <option value="{{ $category_it_taskItem->name }}">{{ $category_it_taskItem->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                {{ Form::hidden('id', $task->id) }}
                                                {!! Form::submit('Изменить', ['class' => 'btn btn-success form-group']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    {!! Form::open(['route' => 'taskIt.mailotvet.add', 'method' => 'post']) !!}
                                        {{ Form::hidden('task_it_id', $task->id) }}
                                        {{ Form::hidden('user_id', Auth::user()->name) }}
                                        {{ Form::hidden('phone', Auth::user()->phone) }}
                                        {{ Form::hidden('email', $task->email) }}

                                        <textarea class="form-control" name="body" cols="50" rows="3" id="text" style="margin-top: 10px"></textarea>
                                        <input class="btn btn-sm btn-outline-secondary" type="submit" value="Ответить пользователю" style="margin-top: 10px; margin-bottom: 10px">
                                    {!! Form::close() !!}


                                </div>
                                <div class="col-sm-6" style="float: left">
                                    {!! Form::open(['route' => 'taskIt.comment.add', 'method' => 'post']) !!}
                                        {{ Form::hidden('task_it_id', $task->id) }}
                                        {{ Form::hidden('user_id', Auth::user()->name) }}
                                        <textarea class="form-control" name="body" cols="50" rows="3" id="text" style="margin-top: 10px"></textarea>
                                        <input class="btn btn-sm btn-outline-secondary" type="submit" value="Оставить комментарий" style="margin-top: 10px; margin-bottom: 10px">
                                    {!! Form::close() !!}
                                    @foreach($task->comments as $comment)
                                        <p><strong style="font-weight: 900;">{{$comment->user_id}}:({{$comment->status}})</strong> {{$comment->body}}<span>       -- {{$comment->created_at->diffForHumans()}}</span></p>
                                    @endforeach



                                </div>
                            </div>
                            <div class="col-lg-12" style="padding-left: 0; padding-right: 0; padding-top: 10px;">
                                <div class="col-sm-6" style="float: left">


                                </div>
                                <div class="col-sm-6" style="float: left">

                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>
    </div>



@endsection
