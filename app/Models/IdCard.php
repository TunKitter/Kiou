<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class IdCard extends Model
{
    protected $collection = 'id_cards';
    protected $fillable = [
        "id",
        'mentor_id',
        "id_prob",
        "name",
        "name_prob",
        "dob",
        "dob_prob",
        "sex",
        "sex_prob",
        "nationality",
        "nationality_prob",
        "home",
        "home_prob",
        "address",
        "address_prob",
        "doe",
        "doe_prob",
        "overall_score",
        "address_entities",
        "type_new",
        "type",
        "religion_prob",
        "religion",
        "ethnicity_prob",
        "ethnicity",
        "features",
        "features_prob",
        "issue_date",
        "issue_date_prob",
        "issue_loc_prob",
        "issue_loc",
        "type",
    ];
}
