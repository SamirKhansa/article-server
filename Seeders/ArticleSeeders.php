<?php
require(__DIR__ . "/../connection/connection.php");
$articles = [
    ['name' => 'The Future of AI', 'author' => 'John Doe', 'description' => 'An article about AI trends and future applications.'],
    ['name' => 'Healthy Living Tips', 'author' => 'Jane Smith', 'description' => 'Tips and tricks for a healthier lifestyle.'],
    ['name' => 'Exploring the Universe', 'author' => 'Carl Sagan', 'description' => 'Insights into space exploration and astronomy.'],
    ['name' => 'The Art of Cooking', 'author' => 'Gordon Ramsay', 'description' => 'Delicious recipes and cooking techniques.'],
    ['name' => 'Travel on a Budget', 'author' => 'Amy Adams', 'description' => 'How to explore the world without breaking the bank.']
];

// Prepare insert statement (id is auto-increment, so not included)
$stmt = $mysqli->prepare("INSERT INTO articles (name, author, description) VALUES (?, ?, ?)");

foreach ($articles as $article) {
    $stmt->bind_param("sss", $article['name'], $article['author'], $article['description']);
    $stmt->execute();
}

echo "Seeding completed successfully.";
$stmt->close();
$mysqli->close();