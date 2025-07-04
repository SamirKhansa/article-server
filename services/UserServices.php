<?php

class UserService {

    // Convert an array of User objects into an array of arrays
    public static function updateArticleProperties($article, array $inputData): void {
        foreach ($inputData as $key => $value) {
            if (property_exists($article, $key)) {
                $article->$key = $value;
            }
        }
    }

    // You can add more user-related utility methods here

}
