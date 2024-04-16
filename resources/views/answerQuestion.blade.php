<html>
<head>
    @include('inc.head')
</head>
<body>
@include('inc.navbar')
<div class="container mt-5">
    <div class="row">
        <h3 class="text-start">Soru: </h3>
        @if($question->question_image != "")
            <div class="col-lg-12 mt-2">
                <div class="card mb-3 bg-acik-turkuaz">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <img onclick="showAnswerImg()" src="{{ $question->question_image }}" class="img-fluid w-100 rounded-start" style="max-height:75vh" alt="...">
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-acik-turkuaz">
                                <p class="card-text card-question-author">{{ $question->question_author_name }}</p>
                                <h5 class="card-title">{{ $question->question_lesson }} / {{ $question->question_subject }}</h5>
                                <p class="card-text">{{ $question->question_text }}</p>
                                <p class="card-text float-end"><small class="text-muted">Eklenme Tarihi: {{ $question->question_date }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-12 mt-2">
                <div class="card mb-3 rounded-5">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text card-question-author">{{ $question->question_author_name }}</p>
                                <h5 class="card-title">{{ $question->question_lesson }} / {{ $question->question_subject }}</h5>
                                <p class="card-text">{{ $question->question_text }}</p>
                                <p class="card-text float-end card-date-container text-turkuaz"><small class="text-muted">Eklenme Tarihi: {{ $question->question_date }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-3">
        <h3 class="text-start">Soruyu Çöz: </h3>
        <div class="col-lg-12 mx-auto ms-auto">
            <div class="card mt-2 mx-auto ms-auto p-4 bg-light text-dark rounded-5">
                <div class="card-body">
                    <div class="container">
                        <form id="answer-form" role="form" method="POST" action="{{ route('answer.store') }}" enctype="multipart/form-data">
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                        @csrf
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="fs-5 mb-1 mt-2" for="form_name">Çözüm Fotoğrafı: </label>
                                            <div class="custom__image-container">
                                                <label id="add-img-label" for="add-single-img">📷</label>
                                                <input id="add-single-img" type="file" name="answer_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="fs-5 mb-1 mt-2" for="form_name">Çözüm Yazısı: </label>
                                        <textarea name="answer_text" rows="6" class="form-control fs-5 border-1 border-dark"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="answer_btn" class="btn btn-primary fs-5 mt-3 w-100" value="Çözümü gönder">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                       @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <h3 class="text-start">Sorunun Çözümleri: </h3>
        @if($question->answers->isNotEmpty())
            @foreach($question->answers as $answer)
                <div class="col-lg-12 mt-2">
                    <div class="card mb-3 bg-light">
                        <div class="row g-0">
                            @if($answer->answer_image != "")
                                <div class="col-md-8">
                                    <img src="{{ $answer->answer_image }}" class="img-fluid w-100 rounded-start" alt="...">
                                </div>
                            @endif
                            <div class="col-md-{{ $answer->answer_image ? '4' : '12' }}">
                                <div class="card-body">
                                    <p class="card-text">{{ $answer->answer_author_name }}</p>
                                    <p class="card-text">{{ $answer->answer_text }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-12 mt-2">
                <div class="alert alert-info" role="alert">
                    Bu soruya henüz bir çözüm eklenmemiş.
                </div>
            </div>
        @endif
    </div>

</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    const imgInputHelper = document.getElementById("add-single-img");
    const imgInputHelperLabel = document.getElementById("add-img-label");
    const imgContainer = document.querySelector(".custom__image-container");
    const imgFiles = [];

    const addImgHandler = () => {
        const file = imgInputHelper.files[0];
        if (!file) return;
        // Generate img preview
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            const newImg = document.createElement("img");
            newImg.src = reader.result;
            imgContainer.insertBefore(newImg, imgInputHelperLabel);
        };
        // Store img file
        imgFiles.push(file);
        // Reset image input
        imgInputHelper.value = imgFiles[0];
        return;
    };

    imgInputHelper.addEventListener("change", addImgHandler);
</script>
</body>
@include('inc.script')
<footer>
    @include('inc.footer')
</footer>
</html>
