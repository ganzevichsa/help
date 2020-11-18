@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Проверить статус заявки</h5>
            </div>
            <div class="card-body">
                <form action="{{route('statusZayavkiYes')}}" method="POST">
                    @csrf
                    <div class="row form-group">
                        <label class="text-sm-right col-sm-2 col-form-label">Введите номер заявки</label>
                        <div class="col-sm-10">
                            <input name="id" placeholder="" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 offset-sm-2">
                            <button class="btn btn-primary">Проверить</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
