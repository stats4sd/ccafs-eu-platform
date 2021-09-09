<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getOutputIdAttribute()
    {
        if ($this->activities->count() > 0) {
            return $this->activities()->first()->output_id;
        }
        return null;
    }

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

    public function getPillarSustainabilityAttribute()
    {
        if ($this->pillars()->count() > 0) {
            $pillars = $this->pillars()->get();
            $output = 0;
            foreach($pillars as $pillar){
                if($pillar->id==1){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }
    }

    public function getPillarAdpatingAttribute()
    {
        if ($this->pillars()->count() > 0) {
            $pillars = $this->pillars()->get();
            $output = 0;
            foreach($pillars as $pillar){
                if($pillar->id==2){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }
    }

    public function getPillarReducingAttribute()
    {
        if ($this->pillars()->count() > 0) {
            $pillars = $this->pillars()->get();
            $output = 0;
            foreach($pillars as $pillar){
                if($pillar->id==3){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }
    }

    public function getSystemValueChainsAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Value chains'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getSystemLandscapeManagementAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Landscape management'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getPracticesEnergyManagementAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Energy management'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getCaptureFisheriesAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Capture fisheries and aquaculture'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getForestryAgroforestryAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Forestry and agroforestry'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getLivestockManagementAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Livestock management'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getWaterManagementAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Water management'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getCropProductionAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Crop production'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getSoilManagementAttribute()
    {
        if ($this->systems()->count() > 0) {
            $systems = $this->systems()->get();
            $output = 0;
            foreach($systems as $system){
                if($system->name=='Soil management'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getServicesForFarmersAttribute()
    {
        if ($this->elements()->count() > 0) {
            $elements = $this->elements()->get();
            $output = 0;
            foreach($elements as $element){
                if($element->id==3){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getEcosystemAttribute()
    {
        if ($this->elements()->count() > 0) {
            $elements = $this->elements()->get();
            $output = 0;
            foreach($elements as $element){
                if($element->id==2){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getManagementOfFarmsAttribute()
    {
        if ($this->elements()->count() > 0) {
            $elements = $this->elements()->get();
            $output = 0;
            foreach($elements as $element){
                if($element->id==1){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getExploitingOpportunitiesAttribute()
    {
        if ($this->investments()->count() > 0) {
            $investments = $this->investments()->get();
            $output = 0;
            foreach($investments as $investment){
                if($investment->id==3){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getUnderstandingAndPlanningAttribute()
    {
        if ($this->investments()->count() > 0) {
            $investments = $this->investments()->get();
            $output = 0;
            foreach($investments as $investment){
                if($investment->id==2){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getManagingClimateRisksAttribute()
    {
        if ($this->investments()->count() > 0) {
            $investments = $this->investments()->get();
            $output = 0;
            foreach($investments as $investment){
                if($investment->id==1){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getEnhancingFinancingAttribute()
    {
        if ($this->main_actions()->count() > 0) {
            $main_actions = $this->main_actions()->get();
            $output = 0;
            foreach($main_actions as $main_action){
                if($main_action->id==4){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getStrengtheningNationalAttribute()
    {
        if ($this->main_actions()->count() > 0) {
            $main_actions = $this->main_actions()->get();
            $output = 0;
            foreach($main_actions as $main_action){
                if($main_action->id==3){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getBuildingPolicyFrameworksAttribute()
    {
        if ($this->main_actions()->count() > 0) {
            $main_actions = $this->main_actions()->get();
            $output = 0;
            foreach($main_actions as $main_action){
                if($main_action->id==2){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getExpandingEvidenceAttribute()
    {
        if ($this->main_actions()->count() > 0) {
            $main_actions = $this->main_actions()->get();
            $output = 0;
            foreach($main_actions as $main_action){
                if($main_action->id==1){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getGenderAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Gender and social inclusion'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getInstitutionalArrangementsAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Institutional arrangements'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getPolicyEngagementAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Policy engagement'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getInfrastructureAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Infrastructure'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getClimateInformationServicesAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Climate information services'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getIndexBasedInsuranceAttribute()
    {
        if ($this->enable_envs()->count() > 0) {
            $enable_envs = $this->enable_envs()->get();
            $output = 0;
            foreach($enable_envs as $enable_env){
                if($enable_env->name=='Index-based insurance'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getScopeLocalisedAttribute()
    {
        if ($this->scopes()->count() > 0) {
            $scopes = $this->scopes()->get();
            $output = 0;
            foreach($scopes as $scope){
                if($scope->name=='Localised (boundaries known)'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getScopeLocalPlusAttribute()
    {
        if ($this->scopes()->count() > 0) {
            $scopes = $this->scopes()->get();
            $output = 0;
            foreach($scopes as $scope){
                if($scope->name=='Local plus (spill over expected)'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getCountryWideAttribute()
    {
        if ($this->scopes()->count() > 0) {
            $scopes = $this->scopes()->get();
            $output = 0;
            foreach($scopes as $scope){
                if($scope->name=='Country wide (one country)'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getMultiCountryAttribute()
    {
        if ($this->scopes()->count() > 0) {
            $scopes = $this->scopes()->get();
            $output = 0;
            foreach($scopes as $scope){
                if($scope->name=='Multi-country'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getGlobalAttribute()
    {
        if ($this->scopes()->count() > 0) {
            $scopes = $this->scopes()->get();
            $output = 0;
            foreach($scopes as $scope){
                if($scope->name=='Global'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getBasicAttribute()
    {
        if ($this->ipflows()->count() > 0) {
            $ipflows = $this->ipflows()->get();
            $output = 0;
            foreach($ipflows as $ipflow){
                if($ipflow->name=='Basic, fundamental research /new knowledge generation'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getRollOutAttribute()
    {
        if ($this->ipflows()->count() > 0) {
            $ipflows = $this->ipflows()->get();
            $output = 0;
            foreach($ipflows as $ipflow){
                if($ipflow->name=='Roll out/implementation/adoption by intermediary or next users'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

    }

    public function getDisseminationAttribute()
    {
        if ($this->ipflows()->count() > 0) {
            $ipflows = $this->ipflows()->get();
            $output = 0;
            foreach($ipflows as $ipflow){
                if($ipflow->name=='	Dissemination/uptake by end users'){
                    $output = 1;
                }
            }
            return $output;
        } else {
            return 0;
        }

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
