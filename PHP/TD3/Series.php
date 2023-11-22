<?php

class Series {
    private $id;
    private $title;
    private $plot;
    private $imdb;
    private $poster;
    private $director;
    private $youtube_trailer;
    private $awards;
    private $year_start;
    private $year_end;

    public function __get($name){
        return $this->{$name};
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPoster()
    {
        return $this->poster;
    }
}

?>