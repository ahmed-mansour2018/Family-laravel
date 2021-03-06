@extends('default')

{{--//FIXME: on this page the 'Laravel Family Tree' heading from the default.blade.php displays at the bottom,
fine on the index page--}}

@section('content')
    <h2>Edit:  {{$person->first}} {{$person->last}} </h2>



    {!! Form::model($person, ['route' => ['people.update', $person->id], 'method' => 'PATCH']) !!}

    @if($user->super_admin)
        <b> Admin fields:</b> <br/>
        @include ('person.partials._admin_fields')
        <b>Regular fields: </b><br/>
    @endif
    {{--//alternative to using route is: 'action' => ['PeopleController@update', $person->id]]) --}}
    @include ('errors.list')
    @include ('person.partials._form', ['submitButtonText' => 'Update Person'])

    {!! Form::close() !!}

    {{--{!! delete_form(['people.destroy', $person->id]) !!}--}}

@stop
