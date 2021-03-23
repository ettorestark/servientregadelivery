<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table          = 'vexsol_store_hours';
    protected $primaryKey     = 'STHR_HORARIO';
    public    $timestamps     = false;

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
    protected $guarded          = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates            = [];



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
     * @return mixed
     */
    public function getSetting()
    {
        return $this->getAttribute('STHR_SETTING');
    }

    /**
     * @param $id
     * @return $this
     */
    public function setSetting($id)
    {
        $this->setAttribute('STHR_SETTING', $id);
        return $this;
    }











    /**
     * @param $setting
     */
    public function getWorkingDays($setting){

        $workingdays = [];

        #get working days and hours
        $settingworkindays = $this->where('STHR_SETTING', $this->getSetting())->get();

        foreach ($settingworkindays as $wday){
            $temp       = [
                'day'       => $wday->STHR_DAY,
                'enabled'   => $wday->STHR_ENABLED == 1 ? true : false,
                'hours' => [
                    0 => ['open'=> $wday->STHR_OPEN, 'close'=> $wday->STHR_CLOSE, 'open2'=> $wday->STHR_OPEN_T2, 'close2'=> $wday->STHR_CLOSE_T2]
                ],
            ];
            $workingdays[$wday->STHR_DAY] = $temp;
        }


        return $workingdays;



    }





}
