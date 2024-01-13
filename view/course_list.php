<?php include('view/header.php'); ?>
<?php
$courses = get_courses();
?>
    <?php  if($courses) {?>
        <section id="list" class="list">
            <header class="list__row list__header">
                <h1>Lista kategorii</h1>
            </header>

            <?php  foreach($courses as $course) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $course['name'] ?></p>
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_course">
                        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
                        <button class="remove-button"> X </button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    <?php } else { ?>
        <p>Nie istnieją jeszcze żadne kategorie</p>
    <?php } ?>

<section id="add" class="add">
    <h2>Dodaj kategorie</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_course">
        <div class="add__inputs">
            <label for="input_name_description">Nazwa:</label>
            <input type="text" name="course_name" maxlength="50" placeholder="Nazwa" id="input_name_description" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Dodaj</button>
        </div>
    </form>
    <br>
    <p><a href=".">Zobacz &amp; Dodaj zadania</a></p>
    <p><a href='processLogin.php?akcja=wyloguj'>Wyloguj</a></p>
</section>


<?php include('view/header.php'); ?>
