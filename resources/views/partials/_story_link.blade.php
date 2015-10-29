@unless ($subject->stories->isEmpty())
    <h5>Special info:</h5>
    <div>
        @foreach($subject->stories as $story)
            <a href="http://www.newribbon.com/family/special/{{$story->slug}}.htm" target="_blank">{{$story->description}}</a>:
            {{$story->text}}...<a href="http://www.newribbon.com/family/special/{{$story->slug}}.htm" target="_blank">Read More</a>
        @endforeach
    </div>
@endunless