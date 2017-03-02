<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Log\Log;

class DefaultTable extends Table
{
    public function find($type = 'all', $options = [])
    {
        // add deleted flag
        if (!empty($options['conditions'])) {
            $conditions = $options['conditions'];
            $conditionsDefault = [
                $this->_alias.'.deleted' => Configure::read('flag_off')
            ];
        } else {
            $conditions = [
                $this->_alias.'.deleted' => Configure::read('flag_off')
            ];
        }

        $options['conditions'] = $conditions;

        return parent::find($type, $options);
    }

    public function getById($id, $fields = ['id'])
    {
        try {
            $entity = $this->find('all', [
                'fields' => $fields,
                'conditions' => [
                    $this->_alias.'.deleted' => Configure::read('flag_off'),
                    $this->_alias.'.id' => $id
                ]
            ])->first();
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }

        if (empty($entity)) {
            return [];
        }

        return $entity->toArray();
    }

    public function add($data)
    {
        if (!array_key_exists('created', $data)) {
            $data['created'] = time();
        }

        if (!array_key_exists('updated', $data)) {
            $data['updated'] = time();
        }

        $entity = $this->newEntity();
        $this->patchEntity($entity, $data);

        try {
            $id = $this->save($entity);
            return $id;
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }
    }

    public function update($data)
    {
        if (!array_key_exists('updated', $data)) {
            $data['updated'] = time();
        }

        $entity = $this->get($data['id']);
        $this->patchEntity($entity, $data);

        try {
            $this->save($entity);
            return true;
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }
    }

    public function getList($fields = ['id'])
    {
        try {
            $entitys = $this->find('all', [
                'fields' => $fields,
                'conditions' => [
                    $this->_alias.'.deleted' => Configure::read('flag_off')
                ],
            ])->hydrate(false)->toArray();
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }

        return $entitys;
    }

    public function deleteById($id)
    {
        try {
            $this->updateAll(
                array(
                    'deleted' => Configure::read('flag_on'),
                    'updated' => time()
                ),
                array(
                    'id' => $id
                )
            );
            return true;
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }
    }

    public function countAll()
    {
        try {
            $count = $this->find('all', [
                'fields' => ['count' => 'Count(*)'],
                'conditions' => [
                    $this->_alias.'.deleted' => Configure::read('flag_off')
                ],
            ])->hydrate(false)->toArray();
            return $count[0]['count'];
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }
    }

    public function paging($data, $fields)
    {
        try {
            $columns = $data['columns'];
            $order_columns = reset($data['order']);

            $conditions = [
                $this->_alias.'.deleted' => Configure::read('flag_off')
            ];

            $searchable_columns = [];
            foreach ($columns as $column) {
                if ($column['searchable'] == 'true') {
                    $searchable_columns[] = $column['name'];
                }
            }

            if (!empty($data['search']['value']))
            {
                foreach ($searchable_columns as $column_search) {
                    $conditions['OR'][ $this->_alias .'.'. $column_search . ' LIKE'] = '%'. $data['search']['value'] .'%';
                }
            }

            $result = $this->find('all', [
                'fields' => $fields,
                'conditions' => $conditions,
                'limit' => $data['length'],
                'offset' => $data['start'],
                'order' => [
                    $columns[$order_columns['column']]['name'] => $order_columns['dir']
                ]
            ])->hydrate(false)->toArray();

            $count = $this->countAll();

            $response = [];
            foreach ($result as $item) {
                $item['created'] = date('d-m-Y H:i', $item['created']);
                $item_value = array_values($item);
                $response[] = $item_value;
            }

            return [
                'draw' => $data['draw'] + 1,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $response
            ];
        } catch (Exception $e) {
            Log::write('debug', $e->getMessage());
            return false;
        }
    }
}