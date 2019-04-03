<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArmyCostRankAllowance extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    public function rank() {
        return $this->hasOne('App\ArmyRank', 'id', 'army_rank_id');
    }

    public static function primeDatabase() {

        $allowances = [
            [
                'points' => 800,
                'army_rank_id' => 'commander',
                'allowance' => 2,
                'minimum' => 1
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'commander',
                'allowance' => 4,
                'minimum' => 1
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'commander',
                'allowance' => 4,
                'minimum' => 2
            ],
            [
                'points' => 600,
                'army_rank_id' => 'commander',
                'allowance' => 2,
                'minimum' => 1
            ],
            [
                'points' => 500,
                'army_rank_id' => 'commander',
                'allowance' => 2,
                'minimum' => 1
            ],

            [
                'points' => 800,
                'army_rank_id' => 'operative',
                'allowance' => 2,
                'minimum' => 0
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'operative',
                'allowance' => 4,
                'minimum' => 0
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'operative',
                'allowance' => 4,
                'minimum' => 0
            ],
            [
                'points' => 600,
                'army_rank_id' => 'operative',
                'allowance' => 2,
                'minimum' => 0
            ],
            [
                'points' => 500,
                'army_rank_id' => 'operative',
                'allowance' => 2,
                'minimum' => 0
            ],

            [
                'points' => 800,
                'army_rank_id' => 'corps',
                'allowance' => 6,
                'minimum' => 3
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'corps',
                'allowance' => 10,
                'minimum' => 6
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'corps',
                'allowance' => 12,
                'minimum' => 6
            ],
            [
                'points' => 600,
                'army_rank_id' => 'corps',
                'allowance' => 6,
                'minimum' => 2
            ],
            [
                'points' => 500,
                'army_rank_id' => 'corps',
                'allowance' => 6,
                'minimum' => 2
            ],

            [
                'points' => 800,
                'army_rank_id' => 'special-forces',
                'allowance' => 3,
                'minimum' => 0
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'special-forces',
                'allowance' => 5,
                'minimum' => 0
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'special-forces',
                'allowance' => 6,
                'minimum' => 0
            ],
            [
                'points' => 600,
                'army_rank_id' => 'special-forces',
                'allowance' => 3,
                'minimum' => 0
            ],
            [
                'points' => 500,
                'army_rank_id' => 'special-forces',
                'allowance' => 3,
                'minimum' => 0
            ],

            [
                'points' => 800,
                'army_rank_id' => 'support',
                'allowance' => 3,
                'minimum' => 0
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'support',
                'allowance' => 5,
                'minimum' => 0
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'support',
                'allowance' => 6,
                'minimum' => 0
            ],
            [
                'points' => 600,
                'army_rank_id' => 'support',
                'allowance' => 3,
                'minimum' => 0
            ],
            [
                'points' => 500,
                'army_rank_id' => 'support',
                'allowance' => 3,
                'minimum' => 0
            ],

            [
                'points' => 800,
                'army_rank_id' => 'heavy',
                'allowance' => 2,
                'minimum' => 0
            ],
            [
                'points' => 1600,
                'army_rank_id' => 'heavy',
                'allowance' => 4,
                'minimum' => 0
            ],
            [
                'points' => 1200,
                'army_rank_id' => 'heavy',
                'allowance' => 4,
                'minimum' => 0
            ],
            [
                'points' => 600,
                'army_rank_id' => 'heavy',
                'allowance' => 2,
                'minimum' => 0
            ],
            [
                'points' => 500,
                'army_rank_id' => 'heavy',
                'allowance' => 2,
                'minimum' => 0
            ]
        ];

        foreach ($allowances as $index => $allowance_data) {
            $allowance = ArmyCostRankAllowance::firstOrNew(['id' => $index + 1]);
            $allowance->fill($allowance_data);
            $allowance->save();
        }

    }


}
