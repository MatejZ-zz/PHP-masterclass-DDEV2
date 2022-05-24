<?php

require_once("helpers/posts.php");
require_once("classes/post.php");

/**
 * Connect to database
 * ddev-DDEV2-db:3306 for https://ddev2.ddev.site/index.php
 * localhost:59863 for http://localhost:63342/
 * @return bool|PDO
 */
function databaseConnection()
{
    $host = "ddev-DDEV2-db:3306";
    $db = "masterclass";
    $user = "root";
    $password = "root";
    $conn = "mysql:host=$host;dbname=$db;charset=UTF8";

    try {
        //echo "Connected to the $db database successfully!";
        return new PDO($conn, $user, $password);
    } catch (PDOException $e) {
        //echo $e->getMessage();
        $host = "localhost:59863";
        $conn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            //echo "Connected to the $db database successfully!";
            return new PDO($conn, $user, $password);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }
    return FALSE;
}

/**
 * Get getArticle by ID
 * @return bool|array
 * transformToKnownStructure
 */
function getArticle( $cID )
{
    $database = databaseConnection();
    if (is_numeric($cID) && $database) {
        //var_dump($database);
        $stmt = $database->prepare("SELECT * FROM posts 
            LEFT JOIN image 
                ON posts.image = image.ID
            LEFT JOIN users 
                ON users.ID = posts.author
            WHERE posts.ID = :id");
        $stmt->execute(['id' => $cID]);
        //$postFromBd = $stmt->fetch();

        if ($postFromBd = $stmt->fetch()) {
            return transformToKnownStructure($postFromBd);
        }
        /*
        if ( array_key_exists($cID, $posts) ) {
            global $clanekID;
            $clanekID = $cID;
            return $posts[$clanekID];
            //return TRUE;
        }
        */
    }
    return FALSE;
}

function allPosts(): array
{
    $database = databaseConnection();
    //var_dump($database);
    $posts = array();
    if ($database){
        $query = "SELECT * FROM posts 
            LEFT JOIN image 
                ON posts.image = image.ID
            LEFT JOIN users 
                ON users.ID = posts.author";

        // Prepare a SQL statement
        $postsFromDb = $database->prepare($query);
        // Execute the statement
        $postsFromDb->execute([]);

        //$s = $database->query($query);
        //$postsFromDb = $s->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($posts1);

        $postNr = 1;
        //foreach ($postsFromDb as $post) {
            // $postString = json_encode($post);
            // echo "$postString<br><br><br>";
            //$posts[$postNr] = transformToKnownStructure($post);
            //$postNr ++;
        //}

        // Use while loop over the array
        while ($row = $postsFromDb->fetch()) {
            //echo $row['name'] . "<br />";
            $posts[$postNr] = transformToKnownStructure($row);
            $postNr ++;
        }

    }

    //{"ID":1,"title":"Where can I get some?","content":"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","image":2,"author":1,"created":1652345293,"updated":1652345293,"url":"https:\/\/www.fillmurray.com\/300\/250","alt":"Fill Murray placeholder image.","username":"janez.novak@example.com","password":"$2y$10$Xudxc0XYPOs9o4lP8evbleLajAEEJ6wWiv\/CyoFIdcjFP5cxDYkFO","name":"Janez","surname":"Novak"}

    /*
    0 => [
        "title" => "What is Lorem Ipsum?",
        "content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        "image" => [
            "url" => "https://www.fillmurray.com/284/196",
            "alt" => "Fill Murray placeholder image."
        ],
        "authored on" => "1652345293",
        "authored by" => 'Janez Novak',
    ],
    */

    // echo "<br>";
    //global $posts;

    //echo "<br>";
    //var_dump($posts);

    return $posts;
}

function transformToKnownStructure($post): array
{
    $transformatedPost = array();
    $transformatedPost["title"] = ( isset( $post["title"] ) ) ? $post["title"] : "";
    $transformatedPost["content"] = ( isset( $post["content"] ) ) ? $post["content"] : "";
    $transformatedPost["image"]["url"] = ( isset( $post["url"] ) ) ? $post["url"] : "images/noImageAvailable.png";
    $transformatedPost["image"]["alt"] = ( isset( $post["alt"] ) ) ? $post["alt"] : "No Image Available.";
    $transformatedPost["authored on"] = ( isset( $post["created"] ) ) ? $post["created"] : "";
    $uName = ( isset( $post["name"] ) ) ? $post["name"] : "";
    $sName = ( isset( $post["surname"] ) ) ? $post["surname"] : "";
    $transformatedPost["authored by"] = "$uName $sName";

    return $transformatedPost;
}

function getUserData($ime, $priimk, $rojstniDan = "1.1.1970"): string
{
    return "$ime $priimk $rojstniDan";
}

function allPostsObj(): array
{
    $database = databaseConnection();
    //var_dump($database);
    $posts = array();
    if ($database){



        $query = "SELECT 
                posts.ID,
                posts.title,
                posts.content,
                posts.author,
                posts.created,
                image.url,
                image.alt,
                users.name,
                users.surname
            FROM posts 
            LEFT JOIN image 
                ON posts.image = image.ID
            LEFT JOIN users 
                ON users.ID = posts.author";
        //$s = $database->query($query);
        //$postsFromDb = $s->fetchAll(PDO::FETCH_ASSOC);

        // Prepare a SQL statement
        $postsFromDb = $database->prepare($query);
        // Execute the statement
        $postsFromDb->execute([]);





        //var_dump($postsFromDb);
        $postNr = 1;
        foreach ($postsFromDb as $post) {
            $postString = json_encode($post);
            echo "$postString<br><br><br>";
            $postId = ( isset( $post["ID"] ) ) ? $post["ID"] : "";
            //echo $postId;
            $uName = ( isset( $post["name"] ) ) ? $post["name"] : "";
            $sName = ( isset( $post["surname"] ) ) ? $post["surname"] : "";
            $authoredBy = "$uName $sName";
            $imageURL = ( isset( $post["url"] ) ) ? $post["url"] : "images/noImageAvailable.png";
            $imageAlt = ( isset( $post["alt"] ) ) ? $post["alt"] : "No Image Available.";
            $posts[$postNr] = new Post($postId, $post["title"], $post["content"], $post["created"], $authoredBy, $imageURL, $imageAlt );
            $postNr ++;
        }
    }
    return $posts;
}
