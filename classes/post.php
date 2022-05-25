<?php
class Post {
    // Properties
    public int $id = -1;
    public string $title = "";
    public string $content = "";
    public int $authoredOn = 0;
    public string $authoredBy = "";
    public array $image;
    public int $lastUpdate = 0;


    // Constructor
    function __construct($id, $title, $content, $authoredOn, $authoredBy, $url = "images/noImageAvailable.png", $alt = "No Image Available.", $lastUpdate = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authoredOn = $authoredOn;
        $this->authoredBy = $authoredBy;
        $this->image[] = $this->setImage($url, $alt);
        $this->lastUpdate = $lastUpdate;
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
    function setLastUpdate($lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }
    function getLastUpdate(): int
    {
        return $this->lastUpdate;
    }
    public function izpisiCeloto()
    {
        echo "<p>".$this->content."</p>";
    }
    public function izpisiCOsnutek(){
        $char = " "; // išči prvi presledek ampak lahko damo tu recimo piko "."
        $pozicijaPrvegaPresledka = strpos(substr($this->content, 150, strlen($this->content) ) , $char);
        $osnutekLen = 151 + $pozicijaPrvegaPresledka; // dodamo še en char ... v grobem to pomeni, če bi iskali piko, bi piko tudi zapisali
        $skrajsanText = substr($this->content, 0, $osnutekLen);
        echo "<br>$skrajsanText...<br>";
    }
    public function izpisiNaslov()
    {
        echo "<H1>".$this->title."</H1>";
    }

    public function izpisiAvtor()
    {
        echo "<H1>".$this->authoredBy."</H1>";
    }

    public function izpisiObjavaDatum()
    {
        $dateTime = date('d-m-Y', $this->authoredOn );
        echo "<H5>".$dateTime."</H5>";
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
