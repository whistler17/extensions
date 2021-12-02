<?php

namespace Itgro;

trait CanCreatedAsEntity
{
    private $id;
    private $fields;

    private $related = [];

    public static function create($id, $fields = []): self
    {
        $entity = new static();

        $entity->setId($id);
        $entity->setFields($fields);

        return $entity;
    }

    public function id()
    {
        return $this->id;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getField($key)
    {
        return (!empty($this->fields)) ? array_get($this->fields, $key) : null;
    }

    public function getRelated($field)
    {
        return array_get($this->related, $field);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setField($key, $value = null)
    {
        $this->fields[$key] = $value;
    }

    public function setRelated($field, $entity)
    {
        $this->related[$field] = $entity;
    }
}
