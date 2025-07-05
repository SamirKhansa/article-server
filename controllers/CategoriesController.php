<?php 

require(__DIR__ . "/../models/Categories.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../services/UpdateArticleProperties.php");

class CategoriesController{
    
    public function getAllCategory(){
        
        global $mysqli;

        if(!isset($_GET["id"])){
            $Category = Categories::all($mysqli);
            $Category_array = ArticleService::articlesToArray($Category); 
            echo ResponseService::success_response($Category_array);
            return;
        }

        $id = $_GET["id"];
        $Category = Categories::find( $id);
        echo ResponseService::success_response($Category);
        return;
    }

    public function deleteAllCategory(){
        global $mysqli;
        if(!isset($_GET["id"])){
            $Category = Categories::DeleteAll($mysqli);
            if($Category){
                echo "All data successfully deleted";
            }
            else{
                echo "Error 404";
            }
            return;
            
        }
        $id = $_GET["id"];
        $Category = Categories::delete($mysqli, $id);
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
        $array=[
            "id"=>$_GET['id'],
            "name"=>$_GET['name'],
            "description"=>$_GET['description']
        ];
        
        $categories=new Categories($array);

        
        

        $success = $categories->update();
        
        if ($success) {
            echo ResponseService::success_response($categories);
        } else {
            echo "Failed to update Category";
        }
    }
    public function createCategory() {
        global $mysqli;

        $inputData = $_GET; 
        $array=[
            "name"=>$_GET['name'],
            "description"=>$_GET['description']
        ];

        $Category = new Categories($array);

        updateArticleProperties::setArticleProperties($Category, $inputData);

        $success = $Category->create($inputData);  

        if ($success) {
            echo ResponseService::success_response($Category);
        } else {
            echo "Failed to create Category";
        }
    }

}



