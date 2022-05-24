<?php
class Post {
    // Properties
    public int $id = -1;
    public string $title = "";
    public string $content = "";
    public int $authoredOn = 0;
    public string $authoredBy = "";
    public array $image;

    // Constructor
    function __construct($id, $title, $content, $authoredOn, $authoredBy, $url = "images/noImageAvailable.png", $alt = "No Image Available.") {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authoredOn = $authoredOn;
        $this->authoredBy = $authoredBy;
        $this->image[] = $this->setImage($url, $alt);
    }

    // Methods
    function getId(): int
    {
        return $this->id;
    }
    function setTitle($title): void
    {
        $this->title = $title;
    }
    function getTitle(): string
    {
        return $this->title;
    }
    function setContent($content): void
    {
        $this->content = $content;
    }
    function getContent(): string
    {
        return $this->content;
    }
    function setAuthoredOn($authoredOn): void
    {
        $this->authoredOn = $authoredOn;
    }
    function getAuthoredOn(): int
    {
        return $this->authoredOn;
    }
    function setAuthoredBy($authoredBy): void
    {
        $this->authoredBy = $authoredBy;
    }
    function getAuthoredBy(): string
    {
        return $this->authoredBy;
    }

    function setImage($url, $alt): void
    {
        $this->image["url"] = $url;
        $this->image["alt"] = $alt;
    }
    function getImage(): array
    {
        return $this->image;
    }


    /*
0 => [
"title" => "What is Lorem Ipsum?",
"content" => "LoreeIpsum.",
"image" => [
"url" => "http84/196",
"alt" => "Fill Mmage."
],
"authored on" => "1652345293",
"authored by" => 'Janez Novak',
],
    */


}
