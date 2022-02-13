<?php

namespace Itgro\Entity;

use Itgro\Entity\IBlock\Element\Entity as IBlockElementEntity;
use Itgro\Entity\IBlock\Section\Entity as IBlockSectionEntity;

trait WithRelationships
{
    protected $relationships = [];

    protected $relationshipsProperties = [];

    protected function hasOne($className, $propertyCode)
    {
        return $this->relationshipsBuilder($className, $propertyCode, false);
    }

    protected function hasMany($className, $propertyCode)
    {
        return $this->relationshipsBuilder($className, $propertyCode);
    }

    private function relationshipsBuilder($className, $fieldCode, $multiple = true)
    {
        if (!array_key_exists($fieldCode, $this->relationships)) {
            $fieldValue = $this->getFieldValue($fieldCode);

            if ($fieldValue) {
                $builder = (new $className)->withFilter(['=ID' => $fieldValue]);

                $this->relationships[$fieldCode] = $multiple ? $builder->getMany() : $builder->getOne();
            } else {
                $this->relationships[$fieldCode] = $multiple ? [] : null;
            }
        }

        return $this->relationships[$fieldCode];
    }

    private function getFieldValue($fieldCode)
    {
        if (!array_key_exists($fieldCode, $this->relationshipsProperties)) {
            if (is_subclass_of($this, IBlockElementEntity::class)) {
                $this->setProperties(['CODE' => $fieldCode]);

                $fieldValue = $this->getPropertyValue($fieldCode);
            } elseif (is_subclass_of($this, IBlockSectionEntity::class)) {
                $this->setUserFields();

                $fieldValue = $this->getField($fieldCode);
            } else {
                $fieldValue = $this->getField($fieldCode);
            }

            $this->relationshipsProperties[$fieldCode] = $fieldValue;
        }

        return $this->relationshipsProperties[$fieldCode];
    }
}
