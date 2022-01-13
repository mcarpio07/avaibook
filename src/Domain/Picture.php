<?php

declare(strict_types=1);

namespace App\Domain;

final class Picture
{

    private int $id;
    private String $url;
    private String $quality;

    public function __construct(int $id, String $url, String $quality)
    {
        $this->id = $id;
		$this->url = $url;
		$this->quality = $quality;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of quality
     */ 
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set the value of quality
     *
     * @return  self
     */ 
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }
}
