@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Почта</h5>
            </div>
            <table class="table table-condensed" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Mail</th>
                    <th>Thema</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                <tr data-toggle="collapse" data-target="#demo{{$message->getNumber()}}" class="collapsed" aria-expanded="false">
                    <td>{{$message->getNumber()}}</td>
                    <td>{{$message->getFrom()->getName()}}</td>
                    <td>{{$message->getFrom()->getAddress()}}</td>
                    <td class="d-none d-md-table-cell">{{$message->getSubject()}}</td>
                </tr>
                <tr>
                    <td colspan="12" class="hiddenRow">
                        <div class="accordian-body collapse" id="demo{{$message->getNumber()}}" style="">
                            <div style="margin-left: 25px">
{{--                                <p style="padding: 20px;"></p>--}}
                                @php echo $message->getBodyText(); @endphp

                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="margin: 25px;">
                                <div class="btn-group">
                                    {!! Form::open(['route' => 'taskIt.addTaskMail', 'method' => 'post']) !!}
                                    {{ Form::hidden('name', $message->getFrom()->getName()) }}
                                    {{ Form::hidden('email', $message->getFrom()->getAddress()) }}
                                    {{ Form::hidden('theme', $message->getSubject()) }}
                                    {{ Form::hidden('text', $message->getBodyText()) }}
                                    {{ Form::hidden('id_mail', $message->getNumber()) }}
                                    {!! Form::submit('Переместить в заявки', ['class' => 'btn btn-sm btn-outline-secondary']) !!}

                                    {!! Form::close() !!}
{{--                                    <button type="button" class="btn btn-sm btn-outline-secondary">Взять в работу</button>--}}
                                </div>

                            </div>
                        </div>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection
