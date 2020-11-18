@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12">
        <div class="card" style="display: flow-root;">
            <div class="card-header">
                <h5 class="card-title">Редактор</h5>
            </div>
            <div class="card-body col-lg-6" style="float: left; border-right: 1px solid">
                {!! Form::open(['route' => 'object.add', 'method' => 'post', 'class' => 'form-edit']) !!}
                    <div class="row form-group">
                        {!! Form::label('name', 'Добавить обьект', ['class' => 'col-sm-12 col-form-label']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('name', $value = null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}

                {!! Form::open(['route' => 'object_to.add', 'method' => 'post', 'class' => 'form-edit']) !!}
                    <div class="row form-group">
                        <div class="col-sm-12">
                            {!! Form::label('name', 'Добавить расположение на объекте', ['class' => 'col-sm-12 col-form-label']) !!}
                                <select required="required" class="form-control" name="object">
                                    @foreach ($objects as $objectItem)
                                        <option value="{{ $objectItem->id }}">{{ $objectItem->name }}</option>
                                    @endforeach
                                </select>
                            {!! Form::text('name', $value = null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="card-body col-lg-6" style="float: left">
                {!! Form::open(['route' => 'category.add', 'method' => 'post', 'class' => 'form-edit']) !!}
                <div class="row form-group">
                    {!! Form::label('name', 'Добавить категорию', ['class' => 'col-sm-12 col-form-label']) !!}
                    <div class="col-sm-12">
                        {!! Form::text('name', $value = null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        {!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>



@endsection
