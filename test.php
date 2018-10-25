<?php

$DirTest = './data/';
if (empty($_GET) && empty($_POST)) {
    exit('Не переданы параметры');
}

if (!empty($_GET['id'])) {
    $NameFileTest = $_GET['id'];
  
$testJson = file_get_contents($DirTest . $NameFileTest);
$testData = json_decode($testJson, true);
$NameTest = $testData['title'];
if ($testJson === false) {
    exit('Тест '.$NameTest.' не найден');
}

$ArrQuestions = $testData['questions'];
} else {
    $NameFileTest = $_POST['id'];
    $testJson = file_get_contents($DirTest . $NameFileTest);
    $testData = json_decode($testJson, true);
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> <?php echo !empty($_GET) ? 'Тест - '. $NameTest : 'Результат теста - ' ;?></title>
</head>
<body>
<?php if (!empty($_GET)): ?>
<h2>
    <?php echo $NameTest; ?>
</h2>


<form action="test.php" method="POST">

    <?php foreach ($ArrQuestions as $key => $question)
        {
            $ArrAnswers = $question['answers'];

            echo"<fieldset>";
            echo "<legend><b>".$question['title']."</b></legend>";

                foreach ($ArrAnswers as $answers=>$answer)
                {

                    echo "<p><input type=\"radio\" name=\"v_".($key)."\" value=\"otv_".$answers."\" >".$answer['title']."</p>";
                }
            echo"</fieldset>";
        }


    ?>

    <hr>
    <input type="hidden" name="id" value="<?php echo $NameFileTest; ?>" />
    <input type="submit" placeholder="Отправить"/>
</form>

<?php elseif (!empty($_POST)): $id_test = $_POST['id'];?>
<?php  $ArrAnswers2 = $testData['questions'];


    foreach ($_POST as $key_post=>$value_post)
    {
        $NamberTest = (substr($key_post,2));
        echo $NamberTest;
        echo "<hr";
        foreach ($ArrAnswers2[$NamberTest] as $x=>$y)
            {
              var_dump($y);
            }


        echo "<hr";

    }

    ?>

<?php endif; ?>
</body>
</html>