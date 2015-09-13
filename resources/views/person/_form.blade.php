
<div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('first','First Name:') !!}
    {!! Form::text('first', null, ['class' => 'form-control']) !!}
    {!! $errors->first('first', '<span class="help-block">:message</span>') !!}

</div>

<div class="form-group">
    {!! Form::label('middle','Middle Name: (optional)') !!}
    {!! Form::text('middle', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('last','Last Name:') !!}
    {!! Form::text('last', null, ['class' => 'form-control']) !!}
    {!! $errors->first('last', '<span class="help-block">:message</span>') !!}
</div>


<div class="form-group">
    {!! Form::label('maiden','Maiden Name: (optional)') !!}
    {!! Form::text('maiden', null, ['class' => 'form-control']) !!}
</div>

{{--//TODO:  make it default to the current value--}}
{{--//FIXME: it doesn't let you skip birthdate (because it tries saving the default string--}}
<div class="form-group">
    {!! Form::label('birthdate','Date of birth: (optional)') !!}
    {!! Form::input('date', 'birthdate', null, ['class' => 'form-control']) !!}
</div>

{{--//TODO:  make it default to the current value--}}
<div class="form-group">
    {!! Form::label('gender','Gender:') !!}
    {!! Form::select('gender', array('unspecified', 'Male'=>'M', 'Female'=>'F'), ['class' => 'form-control']) !!}
</div>

{{--//TODO:  make it default to the current value--}}
<div class="form-group">
    {!! Form::label('keem_bool','Keem Bool:') !!}
    {!! Form::select('keem_bool', array('Choose:',  'True'=>'True', 'False'=>'False'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('husband_bool','Husband Bool:') !!}
    {!! Form::select('husband_bool', array('Choose:',  'True'=>'True', 'False'=>'False'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('kemler_bool','Kemler Bool:') !!}
    {!! Form::select('kemler_bool',array('Choose:',  'True'=>'True', 'False'=>'False'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('kaplan_bool','Kaplan Bool:') !!}
    {!! Form::select('kaplan_bool', array('Choose:',  'True'=>'True', 'False'=>'False'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}

    {{--{!! Form::submit('Save Person', ['class' => 'btn btn-primary form-control']) !!}--}}
</div>
