@extends('layouts.appAdmin')

@section('content')
    <div class="col-sm-12" style="padding: 0">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Баги и предложения</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'bags.add', 'method' => 'post']) !!}
                <div class="form-group col-sm-12" style="padding-left: 10px">
                    <div class="row form-group">
                        {!! Form::label('name', 'Опишите Ваше предложение или замечание', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('name', $value = null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-10 offset-sm-2">
                        {!! Form::submit('Отправить', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <table class="table table-condensed" style="border-collapse:collapse;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="d-none d-md-table-cell"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($bags as $bagItem)
                        <tr class="collapsed" aria-expanded="false">
                            <td>{{$bagItem->id}}</td>
                            <td class="d-none d-md-table-cell">{{$bagItem->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
