{{-- This is where the admin adds questions for each subject, edits, deletes and views them. SUmmernote will be on this page --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Questions Page</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <!-- include summernote css-->
    <link href="{{asset('css/summernote.css')}}" rel="stylesheet">

    <!-- include summernote js-->
    <script src="{{asset('js/summernote.js')}}"></script>

    <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    toolbar: [
                        ['style', ['bold', 'underline','italic']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['picture']],
                        ],
            });
            })
    </script>
    <style>
        form {
            margin-top: 120px;
        }
    </style>

    </head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">One-Time Schools</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Current Subject <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">JSS 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">JSS 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">JSS 3</a>
            </li>
            </ul>
            <span class="navbar-text">
                <a class="nav-link" href="#">Sign out</a>
            </span>
        </div>
    </nav>
    

    <div class="container">
    <form action="{{route('questions',['subject'=>$subject->alias,'class_id'=>$class_id])}}" method="post">
        @csrf
        <textarea name="question" id="summernote"></textarea>

        <div class="form-group row">
            <label for="optionA" class="col-sm-2 col-form-label">Option A</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="optionA" placeholder="Enter optional answers here">
            </div>
        </div>
        <div class="form-group row">
            <label for="optionB" class="col-sm-2 col-form-label">Option B</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="optionB" placeholder="Enter optional answers here">
            </div>
        </div>
        <div class="form-group row">
            <label for="optionC" class="col-sm-2 col-form-label">Option C</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="optionC" placeholder="Enter optional answers here">
            </div>
        </div>
        <div class="form-group row">
            <label for="optionD" class="col-sm-2 col-form-label">Option D</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="optionD" placeholder="Enter optional answers here">
            </div>
        </div>

        <ul>
        <li><input type="radio" name="correct" id="A" value="optionA">A</li>
        <li><input type="radio" name="correct" id="B" value="optionB">B</li>
        <li><input type="radio" name="correct" id="C" value="optionC">C</li>
        <li><input type="radio" name="correct" id="D" value="optionD">D</li>
        </ul>

        <input type="submit" value="Submit question">
    </form>


    </div>


    
</body>
</html>
@foreach ($questions as $question)
    {!!$question->question!!}<br>
    {{$question->options}}

@endforeach
