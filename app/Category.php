<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Events\CategorySermonCountEvent;

use Validator;


class Category extends Model
{

    use Sluggable;
    use SluggableScopeHelpers;
    
    private $errors;

    public function sermons () {
    	return $this-> hasMany('App\Sermon');
    }

    private $updateRules = array(
        'name' => 'required|max:30',
        'description' => 'max:300'
    );

    private $newRules = array(
        'name' => 'required|max:30|unique:categories',
        'description' => 'max:300'
    );

    public function validate($data, $key = "new") {
        if ($key !== "new") {
            $v = Validator::make($data, $this->updateRules);
        } else {
            $v = Validator::make($data, $this->newRules);
        }
        if ($v->fails()) {
            $this->errors = $v->errors()->getMessages();;
            return false;
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected $fillable = [
        'name', 'description',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getUpdatedAtAttribute($value) {
    	return Carbon::parse($value)->format('d-m-Y');
	}
	public function getCreatedAtAttribute($value) {
	    return Carbon::parse($value)->format('d-m-Y');
	}

    public static function countUp ($cartId) {

        $category = Category::whereId((int)($cartId))->first();
        event(new CategorySermonCountEvent($category));

    }

}