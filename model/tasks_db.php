<?php

    function get_assignments_by_course($course_id){
        global $bd;
        if($course_id){
            $query = 'SELECT A.id, A.description, C.name FROM tasks A LEFT JOIN fields C ON A.courseId = C.courseID WHERE A.courseId = :course_id ORDER BY A.id';
        } else {
            $query = 'SELECT A.id, A.description, C.name FROM tasks A LEFT JOIN fields C ON A.courseId = C.courseID ORDER BY C.courseID';
        }
        $statement = $bd-> prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }

    function delete_assignment($assignment_id){
        global $bd;
        $query = 'DELETE FROM tasks WHERE id = :assign_id';
        $statement = $bd-> prepare($query);
        $statement->bindValue(':assign_id', $assignment_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_assignment($course_id, $description){
        global $bd;
        $query = 'INSERT INTO tasks (description, courseId) VALUES (:descr, :courseID)';
        $statement = $bd-> prepare($query);
        $statement->bindValue(':descr', $description);
        $statement->bindValue(':courseID', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }