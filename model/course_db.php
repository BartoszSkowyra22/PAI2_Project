<?php
    function get_courses() {
        global $bd;
        $query = 'SELECT * FROM fields ORDER BY courseID';
        $statement = $bd-> prepare($query);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
    }

    function get_course_name($course_id){
        if (!$course_id){
            return "All Courses";
        }
        global $bd;
        $query = 'SELECT * FROM fields WHERE courseID = :course_id';
        $statement = $bd-> prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $course = $statement->fetch();
        $statement->closeCursor();
        $course_name = $course['name'];
        return $course_name;
    }

    function delete_course($course_id){
        global $bd;

        try {
            $query = 'DELETE FROM fields WHERE courseID = :course_id';
            $statement = $bd->prepare($query);
            $statement->bindValue(':course_id', $course_id);
            $result = $statement->execute();
            $statement->closeCursor();

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    function add_course($course_name){
        global $bd;
        $query = 'INSERT INTO fields (name) VALUES (:courseName)';
        $statement = $bd-> prepare($query);
        $statement->bindValue(':courseName', $course_name);
        $statement->execute();
        $statement->closeCursor();
    }