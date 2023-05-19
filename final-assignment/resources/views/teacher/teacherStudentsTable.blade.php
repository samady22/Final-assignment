@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#studentTable').DataTable();
    })
  </script>
  <title>Student table</title>
</head>

<body>
  <div class="d-flex justify-content-center">
    <div class="btn-group">
      <a href="/teacher" class="btn btn-primary">Tasks</a>
      <a href="/teacher/chart" class="btn btn-secondary">Chart</a>
    </div>
  </div>
  <table id="studentTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Student ID</th>
        <th>Total Tasks</th>
        <th>Submitted Tasks</th>
        <th>Points</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      @if($user->role == 'student')
      <tr>

        <td><a href="chart/{{ $user->id }}">{{ $user->name }}</a></td>
        <td>{{ $user->id }}</td>
        @if ($user->assignments->isNotEmpty())
        @php
        $submittedTasks = 0;
        $totalTasks = 0;
        $points = 0;
        @endphp
        @foreach ($user->assignments as $assignment)
        @php
        $totalTasks++;
        if ($assignment->status == 1) {
        $points += $assignment->points;
        $submittedTasks++;
        }
        @endphp
        @endforeach
        <td>{{ $totalTasks }}</td>
        <td>{{ $submittedTasks }}</td>
        <td>{{ $points }}</td>
        @else
        <td>none</td>
        <td>none</td>
        <td>none</td>

        @endif
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>

  <div class="text-center">
    <div id="buttonContainer"></div>
  </div>
  <script>
    var table = document.getElementById('studentTable');
    var rows = table.querySelectorAll('tr');
    var csvContent = '';

    for (var i = 0; i < rows.length; i++) {
      var cells = rows[i].querySelectorAll('th, td');
      var rowData = [];

      for (var j = 0; j < cells.length; j++) {
        var cell = cells[j];
        rowData.push(cell.innerText);
      }

      csvContent += rowData.join(',') + '\n';
    }

    // Create a download link for the CSV file
    var csvFile = new Blob([csvContent], {
      type: 'text/csv'
    });
    var downloadLink = document.createElement('a');
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = 'table.csv';

    // Create a Bootstrap button
    var button = document.createElement('button');
    button.className = 'btn btn-primary';
    button.innerText = 'Download CSV';
    button.onclick = function() {
      downloadLink.click();
    };

    // Append the button to the document
    var container = document.getElementById('buttonContainer');
    container.appendChild(button);
  </script>

</body>

</html>
@endsection