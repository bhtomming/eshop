<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\10\6 0006
 * Time: 16:22
 */

namespace AppBundle\AdminController;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdmin;

class AdminController extends BaseAdmin
{
    public function createNewUserEntity(){
        $user = $this->get('fos_user.user_manager')->createUser();
        if(!$user instanceof User){
            return null;
        }
        $user->setEnabled(true);
        return $user;
    }

    public function prePersistUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user,false);
    }

    public function preUpdateUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }



}