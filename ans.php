<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://websites.lezasolutions.com/example.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response = json_decode($response, true);

$quizList = $response['quiz'];

$total_correct_ans = 0;
$total_wrong_ans = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz - Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .btn {
            padding: 20px 40px 20px 40px;
            border-radius: 45px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-4 mb-5">
        <h1 class="text-center display-3">Result</h1>
        <div class="mt-4 bg-white p-5 rounded shadow">
        <?php 
            foreach($quizList as $key => $quiz) {
            
                if(isset($_POST[$key])) {

                    echo "<b>".$quiz['question']."</b><br>";

                    $your_ans = $_POST[$key];
                    $write_ans = $quiz['answer'];

                    if($your_ans === $write_ans) {
                        echo "<span class='text-success'>Correct !!</span> <br>";
                        echo "Your Answer : ".$your_ans."<br>";
                        $total_correct_ans += 1;
                    }
                    else {
                        echo "<span class='text-danger'>Wrong !!</span> <br>";
                        echo "Your Answer : ".$your_ans."<br>";
                        echo "Correct Answer : ".$quiz['answer']."<br>";
                        $total_wrong_ans += 1;
                
                    }
                    echo "<hr>";
                }
            }
            
            echo "Total Correct Answers: $total_correct_ans <br>";
            echo "Total Wrong Answers: $total_wrong_ans <br>";
        ?>
        </div>

        <div class="form-group row mt-5 text-center mb-5">
            <div class="col-sm-12">
                <a href="index.html" type="submit" class="btn btn-lg btn-success">Go Home</a>
            </div>
        </div>

        <div class="text-center mt-5 mb-5">
            <p class="text-muted">Vishal Bhosle</p>
        </div>

    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>