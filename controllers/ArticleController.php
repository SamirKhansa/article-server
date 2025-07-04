<?php 

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../services/UpdateArticleProperties.php");

class ArticleController{
    
    public function getAllArticles(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $articles = Article::all($mysqli);
            $articles_array = ArticleService::articlesToArray($articles); 
            echo ResponseService::success_response($articles_array);
            return;
        }

        $id = $_GET["id"];
        $article = Article::find( $id);
        echo ResponseService::success_response($article);
        return;
    }

    public function deleteAllArticles(){
        global $mysqli;
        if(!isset($_GET["id"])){
            $articles = Article::DeleteAll($mysqli);
            if($articles){
                echo "All data successfully deleted";
            }
            else{
                echo "Error 404";
            }
            return;
            
        }
        $id = $_GET["id"];
        $article = Article::delete($mysqli, $id);
        echo ResponseService::success_response($article);
        return;

        
    }

    public function updateArticles() {
        global $mysqli;

        if (!isset($_GET["id"])) {
            echo "Id not found to update the table";
            return;
        }

        $id = $_GET["id"];
        $article = Article::find($id); 
        if (!$article) {
            echo "Article not found";
            return;
        }
        $inputData = $_POST; 
        updateArticleProperties::setArticleProperties($article, $inputData); 

        
        

        $success = $article->update();

        if ($success) {
            echo ResponseService::success_response($article);
        } else {
            echo "Failed to update article";
        }
    }
    public function createArticle() {
        global $mysqli;

        $inputData = $_GET; 

        $article = new Article([]);

        // Set properties safely from input
        updateArticleProperties::setArticleProperties($article, $inputData);

        $success = $article->create($inputData);  

        if ($success) {
            echo ResponseService::success_response($article);
        } else {
            echo "Failed to create article";
        }
    }

}



//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 