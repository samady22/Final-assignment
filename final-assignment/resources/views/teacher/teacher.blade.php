@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/katex.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/katex.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.13.18/contrib/auto-render.min.js"></script> 
    
    <title>Document</title>
</head>

 
<body>
  <div class="d-flex justify-content-center">
    <div class="btn-group">
      <a href="/teacher" class="btn btn-primary">Tasks</a>
      <a href="/teacher/chart" class="btn btn-secondary">Chart</a>
    </div>
  </div>
  


    <div class="row">
        @foreach($tasks as $task)
        <div class="col-md-8">
        <br>
        <h2 class='mx-4'>TASK SET {{ $task['id'] }}</h2>

        @php
            $tasks = json_decode($task['tasks'], true);
        
           foreach ($tasks as $subTask) {
    $text = $subTask['text'];
    $solution = $subTask['solution'];

    // Escape the LaTeX expressions
    $escapedText = htmlspecialchars($text);
    $escapedSolution = htmlspecialchars($solution);

    echo "<p class=mx-4>Task : <span class=\"katex\">" . $escapedText . "</span><br>";
    echo "Solution: <span class=\"katex\">\(" . $escapedSolution . "\)</span></p>";
}


// Render KaTeX for all expressions



        @endphp
      
        </div>
        <div class="col-md-4 justify-content-center">
          <div class="row justify-content-center m-5">
            <h1>edit</h1>
            <form action="{{ route('tasks.update' , $task['id']) }}" method="POST">
                {{csrf_field() }}
                <div class="mb-1">
                  <label for="checkbox" class="form-label">Set Points for this Task</label>
                  <input type="number" class="form-control" id="points" name="points" value="<?php echo $task['points']; ?>">
                </div>
                <div class="mb-1">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox" <?php echo ($task['available'] ? 'checked' : ''); ?>>

                    <label class="form-check-label" for="checkbox">This task is available</label>
                  </div>
                </div>
                <div class="mb-1">
                  <label for="date1" class="form-label">available from:</label>
                  <input type="date" class="form-control" id="date1" name="date1" value="<?php echo $task['dateFrom']; ?>">
                </div>
                <div class="mb-1">
                  <label for="date2" class="form-label">available to:</label>
                  <input type="date" class="form-control" id="date2" name="date2" value="<?php echo $task['dateTo']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save this</button>
              </form>
          </div>
        </div>
    
    @endforeach
   
    </div>
</div>

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