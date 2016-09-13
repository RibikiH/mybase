<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'shipper', 'manager']],
                'message' => 'Please enter a valid role'
            ])
            ->add('username', [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Not unique']
            ]);
    }

    public function getById($id)
    {
        return $this->get($id);
    }
}