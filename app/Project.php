<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name',
    ];

    public function users() 
    {
    	return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

	    Project::creating(function($project)
		{
			$project->hash = substr(str_shuffle(MD5(microtime())), 0, 6);
            $project->yaml = "---

home:
  - jumbo: This is an example
  - heading: Welcome
  - alert: Log in or register|info
  - row:
    - box50:
      - subheading: Log in
      - text_field: Email address
      - password_field: Password
      - checkbox: remember me
      - submit: Log in
    - box50:
      - subheading: Create an account
      - alert: Don't mess this part up|danger
      - text_field: Email address
      - text_field: Email address again
      - password_field: Password
      - password_field: Password again
      - checkbox: I agree to the terms and conditions
      - checkbox: Send me marketing
      - submit: Register
  - line: thin
  - paragraph: Footer links go here.";
		});        
    }
}
