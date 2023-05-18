@extends('layouts.app')


@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/katex.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/katex.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/contrib/auto-render.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var table = $('#assignmentsTable').DataTable();
      })
        </script>
    <title>Document</title>
</head>

<div class="d-flex justify-content-start mb-3">
    <a href="{{ route('tasks.displayStudentTable')}}" class="btn btn-primary">Back</a>
  </div>

<body>
    <table id="assignmentsTable">
      <thead>
        <tr>
          <th>Question</th>
          <th>Status</th>
          <th>Points</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($user->assignments as $assignment)
        <tr>
            @php
                $latexContent = preg_replace('/\\\\begin{equation\*}(.*?)\\\\end{equation\*}/s', '$1',$assignment->question);
            @endphp
          <td><span class="katex">\({{ $latexContent }}\)</span></td>
          <td>{{ $assignment->status == 1 ? 'Submitted' : 'Not Submitted' }}</td>
          <td>{{ $assignment->points }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            renderMathInElement(document.body, {
                delimiters: [
                    { left: "$$", right: "$$", display: true },
                    { left: "\\[", right: "\\]", display: true },
                    { left: "$", right: "$", display: false },
                    { left: "\\(", right: "\\)", display: false }
                ]
            });
        });
      </script>
</body>
</html>



@endsection