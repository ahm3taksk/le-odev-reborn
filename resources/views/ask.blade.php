<html>
<head>
@include('inc.head')

<body class="login-bg-img">
@include('inc.navbar')

<div class="container p-5">
    <div class="row">
        <div class="col-lg-12 bg-glass mx-auto ms-auto">
            <div class="card mt-2 bg-transparent mx-auto ms-auto p-4">
                <div class="card-body">
                    <div class="container bg-transparent text-light">
                        <h1 class="text-center"> Soru Sor</h1>
                        <form id="question-form" action="{{ route('ask') }}" method="POST" enctype="multipart/form-data">
                            @csrf <!-- CSRF koruması için Blade direktifi -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fs-5 mb-1 text-dark" for="lessons">Ders: </label>
                                        <select required class="form-control fs-5 border-1 border-dark" id="lessons" name="question_lesson">
                                            <option value="">Ders seçiniz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fs-5 mb-1 text-dark" for="subjects">Konu: </label>
                                        <select required class="form-control fs-5 border-1 border-dark text-dark" id="subjects" name="question_subject">
                                            <option value="">Konu seçiniz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="fs-5 mb-1 mt-2" for="question_image">Soru Fotoğrafı: </label>
                                        <div class="custom__image-container">
                                            <label id="add-img-label" for="add-single-img">📷</label>
                                            <input id="add-single-img" type="file" name="question_image" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="fs-5 mb-1 mt-2" for="question_text">Soru Yazısı: </label>
                                        <textarea name="question_text" rows="6" class="form-control fs-5 border-1 border-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary fs-5 mt-3 w-100" value="Soru Sor">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('inc.script')
<script>
    // create an array with matematik, fizik, kimya, biyoloji classes and their subjects
    var lessons = [
        {
            name: "Matematik",
            subjects: ["Cebir", "Analiz", "Sayısal Analiz"]
        },
        {
            name: "Fizik",
            subjects: ["Dalga", "Elektromanyetizma", "Optik", "Mekanik", "Isı", "Fizik"]
        },
        {
            name: "Kimya",
            subjects: ["Asitler ve Bazlar", "Mol Kavramı"]
        },
        {
            name: "Biyoloji",
            subjects: ["Hücre", "DNA", "Genetik","RNA"]
        }
    ];

    // get the select element and use jquery
    var $lessons = $("#lessons");
    var $subjects = $("#subjects");

    // add the options to the select element
    $.each(lessons, function (i, lesson) {
        $lessons.append('<option value="' + lesson.name + '">' + lesson.name + '</option>');
    });

    // when the select element changes, get the selected option and add the subjects to the subjects select element
    $lessons.change(function () {
        var selectedLesson = $(this).val();
        var subjects = lessons.find(function (lesson) {
            return lesson.name === selectedLesson;
        }).subjects;

        $subjects.empty();
        $.each(subjects, function (i, subject) {
            $subjects.append('<option value="' + subject + '">' + subject + '</option>');
        });
    });

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
<footer>
    @include('inc.footer')
</footer>
</html>
