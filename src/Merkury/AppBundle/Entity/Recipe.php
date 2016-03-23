<?php
/**
 * Created by Merkury (Víctor Moreno)
 * Date: 19/03/2016
 * Time: 15:38
 */

namespace Merkury\AppBundle\Entity;

use Merkury\AppBundle\Model\CSVModel;

class Recipe extends CSVModel
{
    /**
     * @var $id
     */
    protected $id;

    /**
     * @var $created_at
     */
    protected $createdAt;

    /**
     * @var $updatedAt
     */
    protected $updatedAt;

    /**
     * @var $boxType
     */
    protected $boxType;

    /**
     * @var $title
     */
    protected $title;

    /**
     * @var $slug
     */
    protected $slug;

    /**
     * @var $shortTitle
     */
    protected $shortTitle;

    /**
     * @var $marketingDescription
     */
    protected $marketingDescription;

    /**
     * @var $caloriesKcal
     */
    protected $caloriesKcal;

    /**
     * @var $proteinGrams
     */
    protected $proteinGrams;

    /**
     * @var $fatGrams
     */
    protected $fatGrams;

    /**
     * @var $carbsGrams
     */
    protected $carbsGrams;

    /**
     * @var $bulletpoint1
     */
    protected $bulletpoint1;

    /**
     * @var $bulletpoint2
     */
    protected $bulletpoint2;

    /**
     * @var $bulletpoint3
     */
    protected $bulletpoint3;

    /**
     * @var $recipeDietTypeId
     */
    protected $recipeDietTypeId;
    /**
     * @var $season
     */
    protected $season;

    /**
     * @var $base
     */
    protected $base;

    /**
     * @var $proteinSource
     */
    protected $proteinSource;

    /**
     * @var $preparationTimeMinutes
     */
    protected $preparationTimeMinutes;

    /**
     * @var $shelfLifeDays
     */
    protected $shelfLifeDays;

    /**
     * @var $equipment_needed
     */
    protected $equipmentNeeded;

    /**
     * @var $originCountry
     */
    protected $originCountry;

    /**
     * @var $recipeCuisine
     */
    protected $recipeCuisine;

    /**
     * @var $inYourBox
     */
    protected $inYourBox;

    /**
     * @var $goustoReference
     */
    protected $goustoReference;

    /**
     * @var $rating
     */
    protected $rating;

    /**
     * @var $rating
     */
    protected $displayRating;

    /**
     * @var $rating
     */
    protected $totalRatings;

    public function __construct()
    {
        $now = new \DateTime();
        $this->setCreatedAt($now->format('d/m/Y H:i:s'));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getBoxType()
    {
        return $this->boxType;
    }

    /**
     * @param mixed $boxType
     */
    public function setBoxType($boxType)
    {
        $this->boxType = $boxType;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * @param mixed $shortTitle
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * @return mixed
     */
    public function getMarketingDescription()
    {
        return $this->marketingDescription;
    }

    /**
     * @param mixed $marketingDescription
     */
    public function setMarketingDescription($marketingDescription)
    {
        $this->marketingDescription = $marketingDescription;
    }

    /**
     * @return mixed
     */
    public function getCaloriesKcal()
    {
        return $this->caloriesKcal;
    }

    /**
     * @param mixed $caloriesKcal
     */
    public function setCaloriesKcal($caloriesKcal)
    {
        $this->caloriesKcal = $caloriesKcal;
    }

    /**
     * @return mixed
     */
    public function getProteinGrams()
    {
        return $this->proteinGrams;
    }

    /**
     * @param mixed $proteinGrams
     */
    public function setProteinGrams($proteinGrams)
    {
        $this->proteinGrams = $proteinGrams;
    }

    /**
     * @return mixed
     */
    public function getFatGrams()
    {
        return $this->fatGrams;
    }

    /**
     * @param mixed $fatGrams
     */
    public function setFatGrams($fatGrams)
    {
        $this->fatGrams = $fatGrams;
    }

    /**
     * @return mixed
     */
    public function getCarbsGrams()
    {
        return $this->carbsGrams;
    }

    /**
     * @param mixed $carbsGrams
     */
    public function setCarbsGrams($carbsGrams)
    {
        $this->carbsGrams = $carbsGrams;
    }

    /**
     * @return mixed
     */
    public function getBulletpoint1()
    {
        return $this->bulletpoint1;
    }

    /**
     * @param mixed $bulletpoint1
     */
    public function setBulletpoint1($bulletpoint1)
    {
        $this->bulletpoint1 = $bulletpoint1;
    }

    /**
     * @return mixed
     */
    public function getBulletpoint2()
    {
        return $this->bulletpoint2;
    }

    /**
     * @param mixed $bulletpoint2
     */
    public function setBulletpoint2($bulletpoint2)
    {
        $this->bulletpoint2 = $bulletpoint2;
    }

    /**
     * @return mixed
     */
    public function getBulletpoint3()
    {
        return $this->bulletpoint3;
    }

    /**
     * @param mixed $bulletpoint3
     */
    public function setBulletpoint3($bulletpoint3)
    {
        $this->bulletpoint3 = $bulletpoint3;
    }

    /**
     * @return mixed
     */
    public function getRecipeDietTypeId()
    {
        return $this->recipeDietTypeId;
    }

    /**
     * @param mixed $recipeDietTypeId
     */
    public function setRecipeDietTypeId($recipeDietTypeId)
    {
        $this->recipeDietTypeId = $recipeDietTypeId;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param mixed $base
     */
    public function setBase($base)
    {
        $this->base = $base;
    }

    /**
     * @return mixed
     */
    public function getProteinSource()
    {
        return $this->proteinSource;
    }

    /**
     * @param mixed $proteinSource
     */
    public function setProteinSource($proteinSource)
    {
        $this->proteinSource = $proteinSource;
    }

    /**
     * @return mixed
     */
    public function getPreparationTimeMinutes()
    {
        return $this->preparationTimeMinutes;
    }

    /**
     * @param mixed $preparationTimeMinutes
     */
    public function setPreparationTimeMinutes($preparationTimeMinutes)
    {
        $this->preparationTimeMinutes = $preparationTimeMinutes;
    }

    /**
     * @return mixed
     */
    public function getShelfLifeDays()
    {
        return $this->shelfLifeDays;
    }

    /**
     * @param mixed $shelfLifeDays
     */
    public function setShelfLifeDays($shelfLifeDays)
    {
        $this->shelfLifeDays = $shelfLifeDays;
    }

    /**
     * @return mixed
     */
    public function getEquipmentNeeded()
    {
        return $this->equipmentNeeded;
    }

    /**
     * @param mixed $equipmentNeeded
     */
    public function setEquipmentNeeded($equipmentNeeded)
    {
        $this->equipmentNeeded = $equipmentNeeded;
    }

    /**
     * @return mixed
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * @param mixed $originCountry
     */
    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;
    }

    /**
     * @return mixed
     */
    public function getRecipeCuisine()
    {
        return $this->recipeCuisine;
    }

    /**
     * @param mixed $recipeCuisine
     */
    public function setRecipeCuisine($recipeCuisine)
    {
        $this->recipeCuisine = $recipeCuisine;
    }

    /**
     * @return mixed
     */
    public function getInYourBox()
    {
        return $this->inYourBox;
    }

    /**
     * @param mixed $inYourBox
     */
    public function setInYourBox($inYourBox)
    {
        $this->inYourBox = $inYourBox;
    }

    /**
     * @return mixed
     */
    public function getGoustoReference()
    {
        return $this->goustoReference;
    }

    /**
     * @param mixed $goustoReference
     */
    public function setGoustoReference($goustoReference)
    {
        $this->goustoReference = $goustoReference;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->totalRatings = $this->totalRatings + 1;

        $this->rating = $this->rating + $rating;
    }

    /**
     * @return mixed
     */
    public function getTotalRatings()
    {
        return $this->totalRatings;
    }

    /**
     * @return mixed
     */
    public function setTotalRatings($totalRatings)
    {
        $this->totalRatings = $totalRatings;
    }

    /**
     * @return mixed
     */
    public function getDisplayRating()
    {
        if($this->totalRatings > 0){
            return $this->rating / $this->totalRatings;
        }else{
            return $this->rating;
        }
    }

}