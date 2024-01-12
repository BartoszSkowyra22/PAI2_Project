<?php include('view/header.php'); ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>Assignments</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_assignments">
            <select name="course_id" id="" required>
                <option value="0">View All</option>
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
            <button class="add-button bold">Go</button>
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
                    <input type="hidden" name="action" value="delete_assignement">
                    <input type="hidden" name="assignement_id" value="<?=$assignment['id'] ?>">
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
        <input type="hidden" name="action" value="add_assignement">
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
            <label for="">Opis: </label>
            <input type="text" name="description" maxlength="120" placeholder="Opis" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Dodaj</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_courses">Zobacz/Edytuj zadania</a></p>

<?php include ('view/footer.php'); ?>