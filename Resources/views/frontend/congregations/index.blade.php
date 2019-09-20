@extends('layouts.master')

@section('title')
    {{ trans('membership::congregations.title.congregations') }} | @parent
@stop
@section('meta')
    <meta name="title" content=" {{ trans('membership::congregations.title.congregations') }}" />
    <meta name="description" content="{{''}}" />
@stop
@section('panel-title')
    <h4> {{ trans('membership::congregations.title.congregations') }}</h4>
    <span>{!! ''!!}</span>
@stop
@section('content')
    <div class="widget pad50-65">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>{{trans('membership::congregations.form.name')}}</th>
                <th>{{trans('core::core.table.created at')}}</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($congregations))
                @foreach ($congregations as $congregation)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('admin.membership.congregation.edit', [$congregation->id]) }}">
                                {{ $congregation->id }}
                            </a>
                        </th>

                        <td>
                            <a href="{{ route('admin.membership.congregation.edit', [$congregation->id]) }}">

                        </td>
                        <td>
                            <a href="{{ route('admin.membership.congregation.edit', [$congregation->id]) }}">
                                {{ $congregation->created_at }}
                            </a>
                        </td>
                        <td>
                            <div class="btns-list">
                                <a href="{{ route('admin.membership.congregation.edit', [$congregation->id]) }}" class="brd-rd5 btn scl-btn2"><i class="fa fa-pencil"></i></a>
                                <button class="brd-rd5 btn scl-btn2" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.membership.congregation.destroy', [$congregation->id]) }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop

@section('scripts')

@stop
