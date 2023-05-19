@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container1 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        #downloadButton {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        #downloadButton:hover {
            background-color: #45a049;
        }
    </style>
    <title>Introduction</title>
</head>

<body>

    <div class="container1">
        <h1 id="intro-title">Introduction</h1>

        <p id="intro-pragraph"><strong><u>Teacher GUI:</u></strong> <br> User registration on the website, the role of the registered user should be updated in the database to "Teacher." Once logged in as a teacher, the user will have access to the Teacher site by clicking on the designated Teacher button after login.
            Upon clicking the Teacher button, the teacher will be redirected to a page displaying all available files containing tasks. Each file will have options to modify the tasks within, including availability dates and points assigned to individual tasks.
            When the teacher makes changes, they can save the modifications. Additionally, there will be two buttons at the top of the page. The first button will display the tasks, and the second button will display each student along with their generated tasks, including both submitted and non-submitted tasks, along with the points awarded for submitted tasks.
            All the variables in the table can be sorted by clicking on the respective column headers. By clicking on a student's name, the teacher can view the tasks assigned to that student.
            There is also possibility to download csv file of chart after clicking on download csv. <br><br>

            <strong><u>Student GUI:</u></strong> <br> After logging in as a student you will have the following features for student:
            1) Students will be able to choose from files that are allowed from the teacher's side and will be able to choose one or more files to generate 1 random assignment from that given file or files,
            2) after generating assignments student will be able to have an overview of all generated task for that particular student (authenticated or logged in ) student, green task show that the solution for that task has been submitted, and Red tasks shows that the solution has not been submitted yet, all tasks all shown as divs with title Task i ( i =1,2,3 ...)
            after clicking on the see task button on every task a modal pops out and you shall be able to see the details for that task, the question, status, and image if that task has any image attached.
            then you see an input field for submitting the answer or solution after submitting you will be able to see that the color of that assignment changes to green which means it has been submitted.<br><br>

        </p>
        <div class="text-center">
            <button id="downloadButton">Download introduction</button>
        </div>
    </div>
    <script>
        // Function to handle the button click event
        function downloadAsPDF() {
            // Create a new jsPDF instance
            const doc = new jspdf.jsPDF();

            // Set font size for the title
            doc.setFontSize(24); // Adjust the font size as needed

            // Set font weight for the title
            doc.setFont("helvetica", "bold");

            // Get the inner text of the paragraph
            const paragraphTitle = document.getElementById('intro-title').innerText;
            const paragraphText = document.getElementById('intro-pragraph').innerText;

            // Get the width of the PDF page
            const pageWidth = doc.internal.pageSize.getWidth();

            // Calculate the x-coordinate for center alignment
            const x = (pageWidth - doc.getStringUnitWidth(paragraphTitle) - 40) / 2;

            // Add the title text to the PDF
            doc.text(paragraphTitle, x, 20); // Adjust the y-coordinate as needed

            // Set font size for the paragraph text
            doc.setFontSize(12); // Adjust the font size as needed
            doc.setFont("Helvetica", "normal");

            // Split the paragraph into lines
            const lines = doc.splitTextToSize(paragraphText, pageWidth - 20);

            // Add the lines of text to the PDF with proper padding and line breaks
            doc.text(10, 40, lines); // Adjust the coordinates as needed

            // Save the PDF file
            doc.save('introduction.pdf');
        }

        // Attach an event listener to the button
        const downloadButton = document.getElementById('downloadButton');
        downloadButton.addEventListener('click', downloadAsPDF);
    </script>
</body>

</html>
@endsection