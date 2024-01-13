<?php include('view/header.php'); ?>
<?php
$courses = get_courses();
$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
if(!$course_id){
    $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}
$assignments = get_assignments_by_course($course_id);
?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>Lista zadań</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_assignments">
            <select name="course_id" id="" required>
                <option value="0">Wszystko</option>
                <?php foreach ($courses as $course) : ?>
                <?php if($course_id == $course['courseID']) {?>
                    <option value="<?=$course['courseID']?>" selected>
                <?php } else { ?>
                    <option value="<?=$course['courseID']?>">
                <?php }?>
                    <?=$course['name'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="add-button bold">Szukaj</button>
        </form>
    </header>
    <?php if($assignments) { ?>
        <?php foreach ($assignments as $assignment) : ?>
        <div class="list__row">
            <div class="list__item">
                <p class="bold"><?= $assignments['name'] ?></p>
                <p><?= $assignment['description'] ?></p>
            </div>
            <div class="list__removeItem">
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_assignment">
                    <input type="hidden" name="assignment_id" value="<?=$assignment['id'] ?>">
                    <button class="remove-button"> X </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } else { ?>
        <br>
    <?php if($course_id) { ?>
        <p>Nie istnieją jescze żadne zadania dla tej kategorii</p>
    <?php } else { ?>
        <p>Nie istnieją jeszcze żadne zadania</p>
    <?php } ?>
    <br>
    <?php } ?>

</section>

<section id="add" class="add">
    <h2>Dodaj zadanie</h2>
    <form action="." method="post" id="add__form"  class="add__form">
        <input type="hidden" name="action" value="add_assignment">
        <div class="add_inputs">
            <label for="">Zadanie: </label>
            <select name="course_id" id="" required>
                <option value="">Wybierz kategorię</option>
                <?php foreach ($courses as $course) : ?>
                <option value="<?=$course['courseID']; ?>">
                <?= $course['name']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label for="input_description_for_assignement">Opis: </label>
            <input type="text" name="description" maxlength="120" placeholder="Opis" id="input_description_for_assignement" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Dodaj</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_courses">Zobacz/Edytuj Kategorie</a></p>
<p><a href="processLogin.php?akcja=wyloguj">Wyloguj</a></p>

<?php include ('view/footer.php'); ?>
