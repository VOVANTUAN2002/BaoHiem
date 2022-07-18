<?php
 
namespace App\Views\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $current_user;
 
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->current_user = Auth::user();
       
     
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('current_user', $this->current_user);
    }
}