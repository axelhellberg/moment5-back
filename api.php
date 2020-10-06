<?php
include("config.php"); // config with database variables

header('Content-Type: application/json; charset=UTF-8'); // header for content type
// CORS
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$method = $_SERVER['REQUEST_METHOD']; // variable for request method

$courses = new Course(); // initialize new course class object

switch ($method) { // switch for HTTP-requests
    case "GET": // case for GET-request
        if (isset($_GET['id'])) { // get specific course if id is passed
            $message = $courses->getCourses($_GET['id']);

            if (sizeof($message) > 0) { // course is found
                http_response_code(200); // OK
            } else { // course not found
                http_response_code(404); // not found
            }

        } else { // no id passed
            $message = $courses->getCourses(); // get all courses if no id is passed

            if (sizeof($message) > 0) {
                http_response_code(200);
            } else {
                http_response_code(404);
            }
        }
        break;

    case "POST": // case for POST-request
        $data = json_decode(file_get_contents("php://input")); // get JSON data from Body

        if ($courses->addCourse($data->code, $data->name, $data->progress, $data->syllabus)) { // try to add data with addCourse function
            http_response_code(201); // created
            $message = array("message" => "POST success"); // success message
        } else { // if addCourse function fails
            http_response_code(503); // server error
            $message = array("message" => "POST failed"); // fail message
        }
        break;

    case "PUT": // case for PUT-request
        $data = json_decode(file_get_contents("php://input")); // get JSON data from Body

        if ($courses->updateCourse($data->id, $data->code, $data->name, $data->progress, $data->syllabus)) { // try to update data with updateCourse function
            http_response_code(200);
            $message = array("message" => "PUT success with id: $data->id");
        } else {
            http_response_code(503);
            $message = array("message" => "PUT failed with id: $data->id");
        }
        break;

    case "DELETE": // case for DELETE-request
        $id = file_get_contents("php://input"); // get id from body
        
        if ($courses->deleteCourse($id)) { // try to delete course with passed id
            http_response_code(200);
            $message = array("message" => "DELETE success");
        } else {
            http_response_code(404);
            $message = array("message" => "DELETE failed");
        }
        break;
    
    // case "OPTIONS":
    //     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Content-Type");
    //     header("Access-Control-Allow-Methods: PUT");
    //     http_response_code(204);
    //     break;
}

echo json_encode($message); // show message

?>