<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">Teacher's page</div>
    <div>
        @foreach($tasks as $task)
    <div>
        <br>
        <h2>Task {{ $task['id'] }}</h2>
        
        <p> {{ $task }}</p>
        @php
            $tasks = json_decode($task['tasks'], true);
           
            foreach ($tasks as $subTask) {
                $solution = $subTask['solution'];
                // Perform further operations with the solution
                echo "<p>Solution: $solution</p>";
            }
        @endphp
         

    
        
  
    </div>
    @endforeach
    </div>
</body>

</html>