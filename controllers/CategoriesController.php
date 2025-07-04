<?php 

require(__DIR__ . "/../models/Categories.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../services/UpdateArticleProperties.php");

class CategoryController{
    
    public function getAllCategory(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $Category = Category::all($mysqli);
            $Category_array = ArticleService::articlesToArray($Category); 
            echo ResponseService::success_response($Category_array);
            return;
        }

        $id = $_GET["id"];
        $Category = Category::find( $id);
        echo ResponseService::success_response($Category);
        return;
    }

    public function deleteAllCategory(){
        global $mysqli;
        if(!isset($_GET["id"])){
            $Category = Category::DeleteAll($mysqli);
            if($Category){
                echo "All data successfully deleted";
            }
            else{
                echo "Error 404";
            }
            return;
            
        }
        $id = $_GET["id"];
        $Category = Category::delete($mysqli, $id);
        echo ResponseService::success_response($Category);
        return;

        
    }

    public function updateCategories() {
        global $mysqli;

        if (!isset($_GET["id"])) {
            echo "Id not found to update the table";
            return;
        }

        $id = $_GET["id"];
        $Category = Category::find($id); 
        if (!$Category) {
            echo "Category not found";
            return;
        }
        $inputData = $_POST; 
        updateArticleProperties::setArticleProperties($Category, $inputData); 

        
        

        $success = $Category->update();

        if ($success) {
            echo ResponseService::success_response($Category);
        } else {
            echo "Failed to update Category";
        }
    }
    public function createCategory() {
        global $mysqli;

        $inputData = $_GET; 

        $Category = new Category([]);

        // Set properties safely from input
        updateArticleProperties::setArticleProperties($Category, $inputData);

        $success = $Category->create($inputData);  

        if ($success) {
            echo ResponseService::success_response($Category);
        } else {
            echo "Failed to create Category";
        }
    }

}



