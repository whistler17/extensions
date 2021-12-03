<?php

namespace Itgro\Entity\IBlock\Section;

use Exception;
use Itgro\Entity\IBlock\Base as BaseIBlockEntity;

abstract class Base extends BaseIBlockEntity
{
    protected function getObjects(): \CDBResult
    {
        $this->expandFilter(['IBLOCK_ID' => $this->getIBlockId()]);

        $CIBlockSection = new \CIBlockSection();
        return $CIBlockSection->GetList(
            $this->getOrder(),
            $this->getFilter(),
            $this->getGroupBy(),
            $this->getSelect(),
            $this->getNavParams()
        );
    }

    public function getCount(): int
    {
        $this->expandFilter(['IBLOCK_ID' => $this->getIBlockId()]);

        $CIBlockSection = new \CIBlockSection();
        return $CIBlockSection->GetCount($this->filter);
    }

    public function add($fields): \Bitrix\Main\ORM\Data\AddResult
    {
        $fields = array_merge(
            [
                'ACTIVE' => 'Y',
                'IBLOCK_ID' => $this->getIBlockId(),
            ],
            $fields
        );

        $CIBlockSection = new \CIBlockSection();

        $result = $CIBlockSection->Add($fields);

        if (!$result) {
            throw new Exception($CIBlockSection->LAST_ERROR);
        }

        return $result;
    }

    protected function withGroupBy($value)
    {
        $this->groupBy = (is_bool($value)) ? $value : false;

        return $this;
    }

    protected function expandGroupBy($value)
    {
        return $this->withGroupBy($value);
    }

    protected function getGroupBy()
    {
        return ($this->groupBy) ?? false;
    }
}
