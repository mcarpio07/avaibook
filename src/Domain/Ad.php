<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

final class Ad
{
    private int $id;
    private String $typology;
    private String $description;
    private array $pictures;
    private int $houseSize;
    private ?int $gardenSize = null;
    private ?int $score = null;
    private ?DateTimeImmutable $irrelevantSince = null;

	public function __construct(int $id, String $typology, String $description,array $pictures,int $houseSize, ?int $gardenSize, ?int $score, ?DateTimeImmutable $irrelevantSince)
	{
		$this->id = $id;
		$this->typology = $typology;
		$this->description = $description;
		$this->pictures = $pictures;
		$this->houseSize = $houseSize;
		$this->gardenSize = $gardenSize;
		$this->score = $score;
		$this->irrelevantSince = $irrelevantSince;
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
     * Get the value of typology
     */ 
    public function getTypology()
    {
        return $this->typology;
    }

    /**
     * Set the value of typology
     *
     * @return  self
     */ 
    public function setTypology($typology)
    {
        $this->typology = $typology;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of pictures
     */ 
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set the value of pictures
     *
     * @return  self
     */ 
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;

        return $this;
    }

    /**
     * Get the value of houseSize
     */ 
    public function getHouseSize()
    {
        return $this->houseSize;
    }

    /**
     * Set the value of houseSize
     *
     * @return  self
     */ 
    public function setHouseSize($houseSize)
    {
        $this->houseSize = $houseSize;

        return $this;
    }

    /**
     * Get the value of gardenSize
     */ 
    public function getGardenSize()
    {
        return $this->gardenSize;
    }

    /**
     * Set the value of gardenSize
     *
     * @return  self
     */ 
    public function setGardenSize($gardenSize)
    {
        $this->gardenSize = $gardenSize;

        return $this;
    }

    /**
     * Get the value of score
     */ 
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @return  self
     */ 
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of irrelevantSince
     */ 
    public function getIrrelevantSince()
    {
        return $this->irrelevantSince;
    }

    /**
     * Set the value of irrelevantSince
     *
     * @return  self
     */ 
    public function setIrrelevantSince($irrelevantSince)
    {
        $this->irrelevantSince = $irrelevantSince;

        return $this;
    }
}
