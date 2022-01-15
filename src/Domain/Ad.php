<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;
use phpDocumentor\Reflection\PseudoTypes\False_;

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

    //Constantes de puntuaciones
    private const PUNTUACION_0 = 0;
    private const PUNTUACION_5 = 5;
    private const PUNTUACION_10 = 10;
    private const PUNTUACION_20 = 20;
    private const PUNTUACION_30 = 30;

    private const TIPO_PISO = 'FLAT';
    private const TIPO_CHALET = 'CHALET';

    private const MIN_WORD_PDESC_FLAT = 20;
    private const MAX_WORD_PDESC_FLAT = 49;

    private const  MIN_WORD_PDESC_CHALET = 50;

    private const KEY_WORDS = ['Luminoso','Nuevo','Céntrico','Reformado','Atico'];

    private const iS_RELEVANT = 40;

    private const MIN_SCORE = 0;
    private const MAX_SCORE = 100;


	
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
	 * @brief Indica si un anuncio es relevante o no segun su puntuación
	 */ 
	public function isRelevant(){
        return $this->score >= Ad::iS_RELEVANT ? true : false;
    }


    /**
	 * @brief Calcula la puntuación de un anuncio
	 */ 
	public function calculateScore()
    {
        $score = Ad::PUNTUACION_0;

        //Imágenes
        if(empty($this->pictures)) $score -= Ad::PUNTUACION_10;
        else{
            foreach($this->pictures as $picture){
                if($picture->isHd()) $score += Ad::PUNTUACION_20; 
                else $score += Ad::PUNTUACION_10;
            }
        }

        //Descripción
        if(!empty($this->description)) $score += Ad::PUNTUACION_5;

        //Descripción y tipos
        $numWords = str_word_count($this->description);
        switch ($this->typology){
            case Ad::TIPO_PISO:
                if($numWords >= Ad::MIN_WORD_PDESC_FLAT AND $numWords <= Ad::MAX_WORD_PDESC_FLAT) $score += Ad::PUNTUACION_10;
                elseif($numWords > Ad::MIN_WORD_PDESC_FLAT) $score += Ad::PUNTUACION_30;
            case Ad::TIPO_CHALET:
                if($numWords > Ad::MIN_WORD_PDESC_CHALET) $score += Ad::PUNTUACION_30;
        }

        //Palabras clave
        foreach(Ad::KEY_WORDS as $word){
            echo stripos($this->description, $word);
            if(stripos($this->description, $word) !== FALSE) $score += Ad::PUNTUACION_5;
        }

        //Score en intervalo [0-100]
        if($score > Ad::MAX_SCORE) $score = Ad::MAX_SCORE;
        elseif($score < Ad::MIN_SCORE) $score = Ad::MIN_SCORE;

        $this->score = $score;		
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
