@extends('default')

@section('content')
    <h3>{{$family->caption}}</h3>
    {{--{!! link_to_route('songs.edit', 'Edit this person', $person->first) !!}--}}



    <div class="bottom">


        <div style="float: left; width: 33%;">
             @include ('family.partials._parent_link', ['person' => $mother, 'gender'=>"female"])
        </div>



        <div style="float: left; vertical-align: bottom; width: 33%;">


            @if ($featured_image)
                @foreach($featured_image as $image)
                    <img src="http://newribbon.com/family/images/{{ $image->std_name  }}">
                @endforeach
            @endif

                <br/>

                @unless($family->no_kids_bool)
                    <br/>
                    Kids: <br/>

                    @foreach($kids as $kid)
                        @include ('person.partials._person_link', ['person' => $kid])<br/>
                    @endforeach

                @endunless

        </div>


        <div style="float: left; width: 33%;">
            @include ('family.partials._parent_link', ['person' => $father, 'gender'=>"male"])
        </div>


        <div style="float: left;width: 100%;">

        @if ($family->marriage_date)




            Marriage date: {{ date('F d, Y', strtotime($family->marriage_date)) }} <br/>
            @elseif($family->marriage_date_note)
                Marriage date: {{  $family->marriage_date_note }} <br/>
            {{--@FIXME- this is the part that makes the non-object error when I make a new record in the app (with date)--}}
            {{--@if( $family->marriage_date->month == \Carbon\Carbon::now()->month)--}}
            {{--happy anniversary, {{ $family->caption }} !--}}
            {{--@endif--}}
        @endif

        {{--Marriage Date: @if ($family->marriage_date) {{ $family->marriage_date->toDateString() }} @endif--}}
        @if ($family->marriage_date_note){{  $family->marriage_date_note }} @endif  <br/>

        @if ($family->notes1) Notes 1: {{  $family->notes1 }} @endif  <br/>
        @if ($family->notes2) Notes 2: {{  $family->notes2 }} @endif  <br/>

    <br/>
    Images:
    @foreach($images as $image)
            @include ('partials._image_link', ['image' => $image])
    @endforeach

    <br/>
    <br/>

        </div>
    <div style="float: left;width: 100%;">

    {{--Here's everything: {{$family}}--}}
</div>


@stop

    {{--{!! link_to_route('person.index', 'Back') !!}--}}
