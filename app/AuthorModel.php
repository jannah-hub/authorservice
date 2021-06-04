<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class AuthorModel extends Model  {

 protected $table = 'tblauthors';

 protected $fillable = [ 'fullname', 'gender', 'birthday' ];

 protected $primaryKey = 'author_id';

}
