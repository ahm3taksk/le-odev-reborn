<!-- index.blade.php -->
<div class="container">
    <div class="row p-0 row-gap-4 ms-auto mx-auto">
        @foreach ($questions->sortBy('created_at')->take(6) as $question)
            <div class="col-md-3 col-sm-6 col-12">
                <div class="questionCard">
                    <div class="questionCardTop">
                        @if ($question->question_image)
                            <img onclick="showQuestionImg()" src="{{ $question->question_image }}" class="questionCardImage">
                        @endif
                    </div>
                    <div class="questionCardBottom">
                        <div class="questionCardHeader">
                            <a href="{{ route('index', ['user' => $question->question_author_name]) }}" class="questionCardAuthor"><i class="fa fa-user me-2"></i>{{ $question->question_author_name }}</a>
                            <h5 class="questionCardLesson"><i class="fa fa-book me-2"></i>{{ $question->question_lesson }} - {{ $question->question_subject }}</h5>
                        </div>
                        <div class="questionCardContent">
                            <p class="questionCardText">{{ $question->question_text }}</p>
                        </div>
                        <div class="questionCardFooter">
                            <a href="{{ route('answer.show', ['questionId' => $question->id]) }}" class="btnPrimary">Çöz</a>
                            @if ($question->question_status == 1)
                                <a href="{{ route('index', ['question_id' => $question->id]) }}" class="btnSecondary">Çözümleri Gör</a>
                                <span class="badgeCozuldu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L6.5 10.793l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="w-25 mx-auto mt-5">
          <a class="btnPrimary" href="{{ route('index') }}">Daha Fazla Soru Görüntüle</a>
        </div>
</div>


