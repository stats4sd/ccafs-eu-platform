<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Action extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'actions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['output_id',
    'geo_boundary_id',
    'subactivities_numbers',
    'activities_numbers',
    'outputs_numbers',
    'milestones_numbers',
    'short_label',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getShortLabelAttribute ()
    {
       if($this->short_name != "") {
           return $this->id . ": " . $this->short_name;
       }

       return $this->id . ": " . Str::limit($this->description);
    }


    public function getOutputIdAttribute()
    {
        if ($this->activities->count() > 0) {
            return $this->activities()->first()->output_id;
        }
        return null;
    }

    /**
     * Get the Geoboundary IDs as as comma-separated string
     *
     * @return string
     */
    public function getGeoBoundaryIdAttribute()
    {
        if ($this->geoboundaries()->count() > 0) {
            $geo_ids='';
            $geoboundaries = $this->geoboundaries()->get();
            foreach($geoboundaries as $geo){
                if($this->geoboundaries()->count()==1){
                    return $geo->id;
                }
                $geo_ids = $geo->id.', '.$geo_ids;
            }
           return $geo_ids;
        }
        return 'null';
    }

    /**
     * Extract the 'number' part of the output name field (assumes that the first 2 characters of the name are the number... )
     *
     * @return string
     */
    public function getSubactivitiesNumbersAttribute()
    {
        if ($this->subactivities()->count() > 0) {
            $sub_names='';
            $subactivities = $this->subactivities()->get();
            foreach($subactivities as $sub){
                if($this->subactivities()->count()==1){

                    return substr($sub->name,0, 5);
                }

                $sub_names = substr($sub->name, 0, 5).', '.$sub_names;
            }
           return $sub_names;
        }
        return 'null';
    }

    /**
     * Extract the 'number' part of the output name field (assumes that the first 2 characters of the name are the number... )
     *
     * @return string
     */
    public function getActivitiesNumbersAttribute()
    {
        if ($this->activities()->count() > 0) {
            $act_names='';
            $activities = $this->activities()->get();
            foreach($activities as $act){
                if($this->activities()->count()==1){

                    return substr($act->name, 9, 3);
                }

                $act_names = substr($act->name, 9, 3).', '.$act_names;
            }
           return $act_names;
        }
        return 'null';
    }

    /**
     * Extract the 'number' part of the output name field (assumes that the first 2 characters of the name are the number... )
     *
     * @return string
     */
    public function getOutputsNumbersAttribute()
    {

        if ($this->activities()->count() > 0) {
            $out_names='';
            $activities = $this->activities()->get();

            foreach($activities as $act){

                $output_name = Output::find($act->output_id)->name;
                if($this->activities()->count()==1){
                    return substr($output_name, 6, 2);
                }

                $out_names = substr($output_name, 6, 2).', '.$out_names;
            }
           return $out_names;
        }
        return 'null';
    }


    /**
     * Extract 'number' portion of the Milestone name field (assumes that the first 2 characters are the number... )
     *
     * @return string;
     */
    public function getMilestonesNumbersAttribute()
    {
        if ($this->milestones()->count() > 0) {
            $milestone_names='';
            $milestones = $this->milestones()->get();
            foreach($milestones as $milestone){
                if($this->milestones()->count()==1){

                    return substr($milestone->name, 0, 2);
                }

               $milestone_names = substr($milestone->name, 0, 2).', '.$milestone_names;
            }
           return $milestone_names;
        }
        return 'null';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function effects()
    {
        return $this->belongsToMany(Effect::class, '_link_effects_actions');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, '_link_actions_products');
    }

    public function aims()
    {
        return $this->belongsToMany(Aim::class, '_link_actions_aims');
    }

    public function ipflows()
    {
        return $this->belongsToMany(Ipflow::class, '_link_actions_ipflows');
    }

    public function scopes()
    {
        return $this->belongsToMany(Scope::class, '_link_actions_scopes');
    }

    public function geoboundaries()
    {
        return $this->belongsToMany(GeoBoundary::class, '_link_actions_geo_boundaries');
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, '_link_actions_activities');
    }

    public function subactivities()
    {
        return $this->belongsToMany(Subactivity::class, '_link_actions_subactivities');
    }

    public function milestones()
    {
        return $this->belongsToMany(Milestone::class, '_link_actions_milestones');
    }

    public function pillars()
    {
        return $this->belongsToMany(Pillar::class, '_link_actions_pillars');
    }

    public function systems()
    {
        return $this->belongsToMany(System::class, '_link_actions_systems');
    }

    public function practices()
    {
        return $this->belongsToMany(Practice::class, '_link_actions_practices');
    }

    public function enable_envs()
    {
        return $this->belongsToMany(EnableEnv::class, '_link_actions_enable_envs');
    }

    public function elements()
    {
        return $this->belongsToMany(Element::class, '_link_actions_elements');
    }

    public function investments()
    {
        return $this->belongsToMany(Investment::class, '_link_actions_investments');
    }

    public function main_actions()
    {
        return $this->belongsToMany(MainAction::class, '_link_actions_main_actions');
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
