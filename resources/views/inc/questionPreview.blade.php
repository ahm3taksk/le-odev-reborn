<!-- index.blade.php -->

<div class="container">
    <div class="row p-1 ms-auto mx-auto">
        @foreach ($questions->sortBy('created_at')->take(6) as $question)
            <div class="col-4 mt-2 d-flex align-items-stretch flex-fill">
                <div class="card w-100 card-withimg">
                    @if ($question->question_image)
                        <img onclick="showQuestionImg()" src="{{ $question->question_image }}" class="card-img-top" style="max-height:240px; min-height:240px;">
                    @endif
                    <div class="card-header">
                        <a href="{{ route('index', ['user' => $question->question_author_name]) }}" class="text-decoration-none fs-5 text-primary card-text card-question-author"><i class="fa fa-user me-2"></i>{{ $question->question_author_name }}</a>
                        <h5 class="card-title"><i class="fa fa-book me-2"></i>{{ $question->question_lesson }} - {{ $question->question_subject }}</h5>
                    </div>
                    <div class="card-body bg-acik-turkuaz text-turkuaz card-withimg">
                        <p class="card-text">{{ $question->question_text }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('answer.show', ['questionId' => $question->id]) }}" class="btn rounded-0 btn-primary">Çöz</a>
                        @if ($question->question_status == 1)
                                <a href="{{ route('index', ['question_id' => $question->id]) }}" class="btn rounded-0 btn-success">Çözümleri Gör</a>
                                <span class="fs-4 position-absolute top-0 end-0 badge badge-cozuldu">
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
</div>
