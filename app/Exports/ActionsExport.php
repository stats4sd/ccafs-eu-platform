<?php

namespace App\Exports;

use App\Models\Scope;
use App\Models\Action;
use App\Models\Ipflow;
use App\Models\Pillar;
use App\Models\System;
use App\Models\Element;
use App\Models\Practice;
use App\Models\EnableEnv;
use App\Models\Investment;
use App\Models\MainAction;
use App\Models\LinkEffectAction;
use CreateLinkEffectsActionsTable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ActionsExport implements FromCollection, WithTitle, WithHeadings, WithMapping, WithStrictNullComparison
{

    public $pillars;
    public $systems;
    public $practices;
    public $elements;
    public $investments;
    public $mainActions;
    public $enableEnvs;
    public $scopes;
    public $ipflows;



    public function __construct ()
    {
        $this->pillars = Pillar::all();
        $this->systems = System::all();
        $this->practices = Practice::all();
        $this->elements = Element::all();
        $this->investments = Investment::all();
        $this->mainActions = MainAction::all();
        $this->enableEnvs = EnableEnv::all();
        $this->scopes = Scope::all();
        $this->ipflows = Ipflow::all();
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LinkEffectAction::all();
    }
     /**
     * @return string
     */
    public function title(): string
    {
        return 'Actions';
    }

    public function map($value) : array
    {
        $action = Action::findOrFail($value->action_id)->load('pillars', 'systems', 'practices', 'elements', 'investments', 'main_actions', 'enable_envs', 'scopes', 'ipflows');


        $output = [
                $value->effect_id,
                $value->action_id,
                $action->description,
                $action->start,
                $action->end,
                $action->geo_boundary_id,
                $action->subactivities_numbers,
                $action->activities_numbers,
                $action->outputs_numbers,
                $action->milestones_numbers,

            ];

        // handle select-multiple to boolean conversions:
        foreach($this->pillars as $pillar) {
            $output[] = $action->pillars->contains($pillar) ? 1 : 0;
        }

        foreach($this->systems as $system) {
            $output[] = $action->systems->contains($system) ? 1 : 0;
        }

        foreach($this->practices as $practice) {
            $output[] = $action->practices->contains($practice) ? 1 : 0;
        }

        foreach($this->elements as $element) {
            $output[] = $action->elements->contains($element) ? 1 : 0;
        }

        foreach($this->investments as $investment) {
            $output[] = $action->investments->contains($investment) ? 1 : 0;
        }

        foreach($this->mainActions as $mainAction) {
            $output[] = $action->main_actions->contains($mainAction) ? 1 : 0;
        }

        foreach($this->enableEnvs as $enableEnv) {
            $output[] = $action->enable_envs->contains($enableEnv) ? 1 : 0;
        }

        foreach($this->scopes as $scope) {
            $output[] = $action->scopes->contains($scope) ? 1 : 0;
        }

        foreach($this->ipflows as $ipflow) {
            $output[] = $action->ipflows->contains($ipflow) ? 1 : 0;
        }

        return $output;

    }

    public function headings(): array
    {
        $headings = [
            'effect_id',
            'action_id',
            'description',
            'start',
            'end',
            'geoboundary_id',
            'subactivities',
            'activities',
            'output',
            'milestones',
        ];

        foreach($this->pillars as $pillar) {
            $headings[] = 'pillar-'.$pillar->short_name;
        }

        foreach($this->systems as $system) {
            $headings[] = 'system-'.$system->short_name;
        }

        foreach($this->practices as $practice) {
            $headings[] = 'practice-'.$practice->short_name;
        }

        foreach($this->elements as $element) {
            $headings[] = 'element-'.$element->short_name;
        }

        foreach($this->investments as $investment) {
            $headings[] = 'investment-'.$investment->short_name;
        }

        foreach($this->mainActions as $mainAction) {
            $headings[] = 'main_action-'.$mainAction->short_name;
        }

        foreach($this->enableEnvs as $enableEnv) {
            $headings[] = 'enable_env-'.$enableEnv->short_name;
        }

        foreach($this->scopes as $scope) {
            $headings[] = 'scope-'.$scope->short_name;
        }

        foreach($this->ipflows as $ipflow) {
            $headings[] = 'ipflow-'.$ipflow->short_name;
        }

        return $headings;
    }
}
