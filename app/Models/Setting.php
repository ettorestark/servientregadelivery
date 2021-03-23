<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vexsol_store_settings';
    protected $primaryKey = 'SETT_SETTING';
    public $timestamps = false;
    
    /**,
     * define which attributes are mass assignable (for security)
     *
     * @var array
     */
    protected $fillable = [];

        /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates  = [];


    const  DELETED_AT =  'DELETED_AT';

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * METHOD ATTRIBUTES
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute($this->primaryKey);
    }


    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setAttribute($this->primaryKey, $id);
        return $this;
    }


    /**
     * @param $id
     * @return $this
     */
    public function setStoreId($id)
    {
        $this->setAttribute('SETT_STORE_ID', $id);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoreId()
    {
        return $this->getAttribute('SETT_STORE_ID');
    }


    /**
     * @param $id
     * @return $this
     */
    public function setStoreName($name)
    {
        $this->setAttribute('SETT_STORE_NAME', $name);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoreName()
    {
        return $this->getAttribute('SETT_STORE_NAME');
    }


    /**
     * @param $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->setAttribute('SETT_LANGUAGE', $language);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getAttribute('SETT_LANGUAGE');
    }

    /**
     * @param $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->setAttribute('SETT_COUNTRY', $country);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->getAttribute('SETT_COUNTRY');
    }

    /**
     * @param $description
     * @return $this
     */
    public function setMethodDescription($description)
    {
        $this->setAttribute('SETT_METHOD_DESCRIPTION', $description);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodDescription()
    {
        return $this->getAttribute('SETT_METHOD_DESCRIPTION');
    }



    /**
     * @param $status
     * @return $this
     */
    public function setCreateStatus($status)
    {
        $this->setAttribute('SETT_CREATE_STATUS', $status);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateStatus()
    {
        return $this->getAttribute('SETT_CREATE_STATUS');
    }


    /**
     * @param $allow
     * @return $this
     */
    public function setAllowScheduled($allow)
    {
        $this->setAttribute('SETT_ALLOWSCHEDULED', $allow);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowScheduled()
    {
        return $this->getAttribute('SETT_ALLOWSCHEDULED') == 1;
    }

    /**
     * @return mixed
     */
    public function getAllowFirstWidget()
    {
        return $this->getAttribute('SETT_ALLOWFIRSTWIDGET') == 1;
    }


    /**
     * @param $firstWidget
     * @return $this
     */
    public function setAllowFirstWidget($firstWidget)
    {
        $this->setAttribute('SETT_ALLOWFIRSTWIDGET', $firstWidget);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowSecondWidget()
    {
        return $this->getAttribute('SETT_ALLOWSECONDWIDGET') == 1;
    }


    /**
     * @param $secondtWidget
     * @return $this
     */
    public function setAllowSecondWidget($secondtWidget)
    {
        $this->setAttribute('SETT_ALLOWSECONDWIDGET', $secondtWidget);
        return $this;
    }


    /**
     * @param  int $enable
     * @return $this
     */
    public function setEnable($enable)
    {
        $this->setAttribute('SETT_ENABLE', $enable);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->getAttribute('SETT_ENABLE');
    }


    /**
     * @param $id
     * @return $this
     */
    public function setServer($server)
    {
        $this->setAttribute('SETT_SERVER', $server);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->getAttribute('SETT_SERVER');
    }


    /**
     * @param $api
     * @return $this
     */
    public function setServientregaApi($api)
    {
        $this->setAttribute('SETT_SERVIENTREGA_API', $api);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServientregaApi()
    {
        return $this->getAttribute('SETT_SERVIENTREGA_API');
    }

    /**
     * @param $secret
     * @return $this
     */
    public function setServientregaSecret($secret)
    {
        $this->setAttribute('SETT_SERVIENTREGA_SECRET', $secret);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServientregaSecret()
    {
        return $this->getAttribute('SETT_SERVIENTREGA_SECRET');
    }


     /**
     * @param $secret
     * @return $this
     */
    public function setServientregaBillingCode($secret)
    {
        $this->setAttribute('SETT_SERVIENTREGA_BILLING_CODE', $secret);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServientregaBillingCode()
    {
        return $this->getAttribute('SETT_SERVIENTREGA_BILLING_CODE');
    }


    /**
     * @param $apikey
     * @return $this
     */
    public function setGoogleApiKey($apikey)
    {
        $this->setAttribute('SETT_GOOGLE_API', $apikey);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoogleApiKey()
    {
        return $this->getAttribute('SETT_GOOGLE_API');
    }


    /**
     * @param $apikey
     * @return $this
     */
    public function setMethodTitle($title)
    {
        $this->setAttribute('SETT_METHOD_TITLE', $title);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodTitle()
    {
        return $this->getAttribute('SETT_METHOD_TITLE');
    }



    /**
     * @param $type
     * @return $this
     */
    public function setCostType($type)
    {
        $this->setAttribute('SETT_COST_TYPE', $type);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCostType()
    {
        return $this->getAttribute('SETT_COST_TYPE');
    }

    /**
     * @param $cost
     * @return $this
     */
    public function setCostDefault($cost)
    {
        $this->setAttribute('SETT_COST_DEFAULT', $cost);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCostDefault()
    {
        return $this->getAttribute('SETT_COST_DEFAULT');
    }

    /**
     * @param $percentage
     * @return $this
     */
    public function setPercentageDefault($percentage)
    {
        $this->setAttribute('SETT_PERCENTAGE_DEFAULT', $percentage);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPercentageDefault()
    {
        return $this->getAttribute('SETT_PERCENTAGE_DEFAULT');
    }

    /**
     * @param $freefor
     * @return $this
     */
    public function setFreeForDefault($freefor)
    {
        $this->setAttribute('SETT_FREE_FOR_DEFAULT', $freefor);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFreeForDefault()
    {
        return $this->getAttribute('SETT_FREE_FOR_DEFAULT');
    }




    /**
     * @param $cost
     * @return $this
     */
    public function setValidated($valid)
    {
        $this->setAttribute('SETT_VALIDATED', $valid);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->getAttribute('SETT_VALIDATED') == 1;
    }


    /**
     * @param $enable
     * @return $this
     */
    public function setEnableAllProducts($enable)
    {
        $this->setAttribute('SETT_ENABLE_ALL_PRODUCTS', $enable);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnableAllProducts()
    {
        return $this->getAttribute('SETT_ENABLE_ALL_PRODUCTS') === "S";
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->setAttribute('SETT_IMAGE', $image);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->getAttribute('SETT_IMAGE');
    }


    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Relations
     * -----------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return \App\Models\Store
     */
    public function store(){
        return $this->hasOne('App\Models\Store','STORE_ID','SETT_STORE_ID');
    }


    /**
     * @return \App\Models\EMVexlocations
     */
    public function locations(){
        return $this->hasMany('App\Models\Location','STLO_SETTING','SETT_SETTING');
    }

    /**
     * @return \App\Models\EMVexhours
     */
    public function workinghours(){
        return $this->hasMany('App\Models\Hour','STHR_SETTING','SETT_SETTING');
    }

    /**
     * @return \App\Models\Holiday
     */
    public function hollydays(){
        return $this->hasMany('App\Models\Holiday','HODAY_SETTING','SETT_SETTING');
    }


    /**
     * @return \App\Models\Shopify\Metadata
     */
    public function metadata(){
        return $this->hasMany('App\Models\EMMetadata','META_SETTING','SETT_SETTING');
    }



    /**
     * -----------------------------------------------------------------------------------------------------------------
     * METODOS PARA EL MANEJO DE LOS ATRIBUTOS
     * -----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Find the config user
     * @param $id
     * @return \App\Models\Setting
     */
    public static function  findByStoreId($id){

        return self::withTrashed()->where('SETT_STORE_ID', $id)->first();
    }

}