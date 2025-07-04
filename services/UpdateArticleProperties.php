<?php

class updateArticleProperties {


    public static function setArticleProperties($article, array $inputData): void {
        foreach ($inputData as $key => $value) {
            if (property_exists($article, $key)) {
                $article->$key = $value;
            }
        }
    }
}