<?php 


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


$basePath = "/MODUL4/demo/backend/dbconfig.php/api/ikan";


$id = null;
if (strpos($uri, $basePath) === 0) {
    $pathParts = explode('/', trim(str_replace($basePath, '', $uri), '/'));
    if (!empty($pathParts[0])) {
        $id = $pathParts[0];
    }
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "web_modul4";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


switch ($method) {
    case 'GET':
        if ($id) {
           
            $sql = "SELECT id, fish_image, price, fish_name FROM ikan WHERE id = $id";
        } else {
         
            $sql = "SELECT id, fish_image, price, fish_name FROM ikan";
        }

        $result = $conn->query($sql);
        $items = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['fish_image'] = '/MODUL4/demo/frontend/img/' . $row['fish_image'];
                $items[] = $row;
            }
            echo json_encode($items);
        } else {
            echo json_encode([]);
        }
        break;

    case 'POST':
     
        $data = json_decode(file_get_contents('php://input'), true);
        $fish_name = $data['fish_name'];
        $price = $data['price'];
        $fish_image = $data['fish_image'];

        $sql = "INSERT INTO ikan (fish_image, price, fish_name) 
                VALUES ('$fish_image', '$price', '$fish_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Fish added successfully']);
        } else {
            echo json_encode(['message' => 'Error adding fish: ' . $conn->error]);
        }
        break;

    case 'PUT':
    
        if ($id) {
            $data = json_decode(file_get_contents('php://input'), true);
            $fish_name = $data['fish_name'];
            $price = $data['price'];
            $fish_image = $data['fish_image'];

            $sql = "UPDATE ikan SET fish_image = '$fish_image', price = '$price', fish_name = '$fish_name' WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Fish updated successfully']);
            } else {
                echo json_encode(['message' => 'Error updating fish: ' . $conn->error]);
            }
        } else {
            echo json_encode(['message' => 'ID is required to update']);
        }
        break;

    case 'DELETE':
        
        if ($id) {
            $sql = "DELETE FROM ikan WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Fish deleted successfully']);
            } else {
                echo json_encode(['message' => 'Error deleting fish: ' . $conn->error]);
            }
        } else {
            echo json_encode(['message' => 'ID is required to delete']);
        }
        break;

    default:
        echo json_encode(['message' => 'Request method not supported']);
        break;
}

$conn->close();
?>
