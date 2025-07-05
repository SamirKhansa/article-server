<?php
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../models/Article.php");

class CategorySeeders{
    public static function AddCategories(){
        global $mysqli;
        $categories = [
            ['name' => 'Technology', 'description' => 'Articles related to technology and innovation.'],
            ['name' => 'Health', 'description' => 'Health, wellness, and medical articles.'],
            ['name' => 'Science', 'description' => 'Scientific discoveries and research articles.'],
            ['name' => 'Cooking', 'description' => 'Recipes, cooking tips, and food articles.'],
            ['name' => 'Travel', 'description' => 'Travel guides, tips, and experiences.']
        ];


        $stmt = $mysqli->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");

        foreach ($categories as $category) {
            $stmt->bind_param("ss", $category['name'], $category['description']);
            $stmt->execute();
        }

        echo "Categories seeded successfully.";
    }

}


