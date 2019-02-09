Laravel 使用多个数据库连接
https://learnku.com/articles/16414/laravel-uses-multiple-database-connections


$php artisan make:model Models/Users -m

//$php artisan make:migration create_users_table --create=users

class PlanHistory extends Model
{

    protected $table = 'plan_history';
}