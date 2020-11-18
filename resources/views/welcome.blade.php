@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Быстрая заявка</h5>
                <h6 class="card-subtitle text-muted">Сделайте быструю заявку в ИТ-отдел, опишите Вашу проблему, оставьте свой контакт, обязательно запомните номер заявки </h6>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'taskIt.add', 'method' => 'post']) !!}
                <div class="row form-group">
                    {!! Form::label('name', 'Фамилия Имя', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', $value = null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    {!! Form::label('contact', 'Номер телефона', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('contact', $value = null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    {!! Form::label('email', 'Ваш  E-mail', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email', $value = null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="row form-group">
                    {!! Form::label('name', 'Рассположение', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        <select required="required" class="form-control" name="object_to">
                            <option value="Нет в списке|Нет в списке">Нет в списке</option>
                            @foreach ($objects as $objectItem)
                                <optgroup label="{{ $objectItem->name }}" style="font-size: 16px; font-weight: 600;"></optgroup>
                                @foreach($objectItem->object_tos as $objectItem_to)
                                    <option value="{{ $objectItem_to->name }}|{{ $objectItem->name }}">- {{ $objectItem_to->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    {!! Form::label('text', 'Опишите Вашу проблему', ['class' => 'text-sm-right col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('text', $value = null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-10 offset-sm-2">
                        {!! Form::submit('Отправить', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
