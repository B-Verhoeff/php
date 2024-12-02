<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulieren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<h2>Review</h2>
<form method="post" action="">
    <div class="mb-3">
        <label for="n" class="form-label">Naam</label>
        <input type="text" class="form=control" id="n" name="naam"
        value="<?php echo $_POST['name'] ?? '' ?>">
        <div class="form-text text-danger">
            <?= $errors['name'] ?? '' ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="b">Review</label>
        <textarea name="review" id="b" class="form-control">
            <?php echo $_POST['review'] ?? '' ?>
        </textarea>
        <div class="form-text text-danger">
            <?= $errors['review'] ?? '' ?>
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="a" name="akkoord" value="akkoord">
        <?php echo (isset($_POST['agree'])?'checked="checked"':'')?>>
        <label class="form-check-label" for="a">accepteer voorwaarden</label>
        <div class="form-text text-danger">
            <?= $errors['agree'] ?? '' ?>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" name="verzenden" value="verzenden">
</form>

<?php
include 'dbconnect.php';

const NAME_REQUIRED = 'Naam invullen';
const REVIEW_REQUIRED = 'Review invullen';
const AGREE_REQUIRED = 'Voorwaarden accepteren';

$errors = [];
$inputs = [];

if(isset($_POST['verzenden'])) {
    echo "Het formulier is verzonden!<br>";
    $name = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_SPECIAL_CHARS);
    echo "Naam: ". $name."<br>";
    $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS);
    echo "Bericht: ". $review."<br>";
    if(isset($_POST['akkoord']))
    {
        echo "voorwaarden geaccepteerd!";
    }
}

// sanitize and validate name
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$name = trim($name);
if (empty($name)) {
    $errors['name'] = NAME_REQUIRED;
} else {
    $inputs['name'] = $name;
}

//sanitize and validate review
$review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS);

$review = trim($review);
if (empty($review)) {
    $errors['review'] = REVIEW_REQUIRED;
} else {
    $inputs['review'] = $review;
}

//accept terms
$agree = filter_input(INPUT_POST, 'agree', FILTER_SANITIZE_SPECIAL_CHARS);

// kijk of agree in de $_POST array zit, filter_input geeft null terug als agree er niet bij zit.
if ($agree === null) {
    $errors['agree'] = AGREE_REQUIRED;
} else {
    $inputs['agree']=$agree;
}

if (count($errors) === 0) {
    global $db;

    $sth =$db->prepare('INSERT INTO review (name,content) VALUES (:name,:review)');
    $sth->bindParam(':name', $_POST['name']);
    $sth->bindParam(':review', $_POST['review']);
    $result=$sth->execute();

    header("Location: master.php");
}
?>

</body>
</html>