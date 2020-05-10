<?php

namespace App\Repositories\Eloquent;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

    protected $model = User::class;
    
    public function create(array $data):bool{

        $data['password']= Hash::make($data['password']);
        $register = $this->model->create($data);
        if(isset($data['roles']) && count($data['roles'])){
            foreach ($data['roles'] as $key => $value) {
                $register->roles()->attach($value);
                
            }
           
        }
        return (bool) $register;
    }

    public function update(array $data,int $id):bool{
        $register = $this->find($id);
 
        /*if(!$register->can("edit-user")){
            return false;
        }*/
        
        if($register){
            if($data['password'] ?? false){
                $data['password']= Hash::make($data['password']);
                return (bool) $register->update($data);
            }

            $roles = $register->roles;
            if(count($roles)){
                foreach ($roles as $key => $value) {
                    $register->roles()->detach($value->id);
                }
            }
            if(isset($data['roles']) && count($data['roles'])){
                foreach ($data['roles'] as $key => $value) {
                    $register->roles()->attach($value);
                }
               
            }
            return (bool) $register->update($data);
            
        }else{
            return false;
        }
        
     }

    
    
} 


?>