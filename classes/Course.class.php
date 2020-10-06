<?php 
class Course {
    private $db;

    function __construct() { // constructor for database connection
        $this->db = new PDO (
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4", DBUSER, DBPASS
        );
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    
    public function addCourse($code, $name, $progress, $syllabus) { // function to add course
        $data = array( // array with data with stripped tags
            'code' => strip_tags($code),
            'name' => strip_tags($name),
            'progress' => strip_tags($progress),
            'syllabus' => strip_tags($syllabus)
        );

        $stmt = $this->db->prepare("INSERT INTO course (code, name, progress, syllabus) VALUES (:code, :name, :progress, :syllabus)"); // prepared statement for SQL

        return $stmt->execute($data); // execute statement with data array
    }

    public function getCourses($id = false) {  // function for getting course or courses
        if ($id) { // if id parameter
            $stmt = $this->db->prepare("SELECT * FROM course WHERE id = :id"); // statement for getting single course with id

            $stmt->execute([ "id" => $id ]); // execute
            
            $row = $stmt->fetch(); // get single row

            return $row; // return single row
        } else { // if id parameter is false
            $stmt = $this->db->prepare("SELECT * FROM course"); // statement for getting all courses

            $stmt->execute(); // execute

            $rows = $stmt->fetchAll(); // get all rows

            return $rows; // return all rows
        }
    }

    public function deleteCourse($id) { // function for deleting course
        $stmt = $this->db->prepare("DELETE FROM course WHERE id = :id"); // statement for deleting specific course with id

        return $stmt->execute([ "id" => $id ]); // execute function with passed id, return true/false
    } 

    public function updateCourse($id, $code, $name, $progress, $syllabus) { // function for updating specific course
        $data = array( // data array with stripped tags and id number
            'code' => strip_tags($code),
            'name' => strip_tags($name),
            'progress' => strip_tags($progress),
            'syllabus' => strip_tags($syllabus),
            'id' => $id
        );

        $stmt = $this->db->prepare("UPDATE course SET code = :code, name = :name, progress = :progress, syllabus = :syllabus WHERE id = :id"); // statment for updating specific course with id

        return $stmt->execute($data); // execute statement with new data
    }
}

?>