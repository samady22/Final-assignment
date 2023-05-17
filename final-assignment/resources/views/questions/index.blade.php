@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 border-right  border-success">
                <h3 class="h3">Select files to generate task</h3>
                <form id="fileSelectionForm" action="{{ route('getRandomQuestion') }}" method="POST">
                    @csrf
                    <div class="form-check">
                        @foreach ($latexFileNames as $latexFileName)
                            <input class="form-check-input" type="checkbox" name="latex_files[]"
                                   value="{{ $latexFileName }}" id="fileCheckbox{{ $loop->index }}">
                            <label class="form-check-label"
                                   for="fileCheckbox{{ $loop->index }}">{{ $latexFileName }}</label><br>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Generate task</button>
                </form>
            </div>
            <div class="col-md-4 ">
                <h4>Description:</h4>
                <div class="description">
                    <div class="bg-success" style="height: 20px; width: 20px; display: inline-block;"></div>
                    <span>submitted assignments</span>
                </div>
                <div class="description">
                    <div class="bg-danger" style="height: 20px; width: 20px; display: inline-block;"></div>
                    <span>NOT-submitted Assignments</span>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="h3 text-center">All Assignments of <span class="text-secondary rounded p-1">{{$user}}</span></h3>
                <hr>
                <div class="row ">
                    @foreach ($assignments as $index => $assignment)
                        <div class="card {{ $assignment->status === 'submitted' ? 'bg-success' : 'bg-danger' }} m-2" style="width: 13rem;">
                            <div class="card-body text-center">
                                <h5 class="card-title text-light">Task {{ $index + 1 }}</h5>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal{{ $assignment->id }}">
                                    See Task
                                </button>
                                <div class="modal fade" id="myModal{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content " style="background-color: #E6FDF8">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Assignment</h4>
                                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p class="math-content">{{ $assignment->question }}</p>
                                                @if($assignment->image_path != null)
                                                    <img src="{{ asset('storage/questions/images/' . $assignment->image_path) }}" style="width: 30rem; height: 12rem;" alt="Image">
                                                @endif
                                                <h5><span class="bg-warning text-dark rounded">Status: {{ $assignment->status }}</span></h5>
                                                <form action="{{ route('assignments.update') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="text-secondary text-left" for="inputField">Solution:</label>
                                                        <input type="text" class="form-control" name="answer" id="inputField" placeholder="Write down Your solution here!" required>
                                                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}" >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit Solution</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.0/es5/tex-mml-chtml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex/dist/katex.min.css" integrity="sha384-3UiQGuEI4TTMaFmGIZumfRPtfKQ3trwQE2JgosJxCnGmQpL/lJdjpcHkaaFwHlcI" crossorigin="anonymous">

    <script>
        $(document).ready(function() {
            // Initialize the modal
            $('#myModal').modal();

            // Render math content
            renderMath(document.body);
        });

        $('#myModal').on('shown.bs.modal', function() {
            // Render math content inside the modal
            renderMath(this);
        });

        function renderMath(element) {
            var mathElements = element.getElementsByClassName('math-content');
            for (var i = 0; i < mathElements.length; i++) {
                var latex = mathElements[i].textContent;
                latex = latex.replace(/\$(.*?)\$/g, function(match, latexCode) {
                    return latexCode ;
                });
                var mathHTML = katex.renderToString(latex, {
                    throwOnError: false
                });
                mathElements[i].innerHTML = mathHTML;
            }
        }
    </script>
@endsection

