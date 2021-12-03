<?php

namespace Itgro\Entity\IBlock\Element;

use CDBResult;
use CIBlockElement;
use Exception;
use Itgro\Bitrix\Admin\WithAdditionalExtensions;
use \Itgro\Entity\IBlock\Base as BaseIBlockEntity;

abstract class Base extends BaseIBlockEntity
{
    use WithAdditionalExtensions;

    protected function getObjects(): CDBResult
    {
        $this->expandFilter(['IBLOCK_ID' => $this->getIBlockId()]);

        $CIBlockElement = new CIBlockElement();
        return $CIBlockElement->GetList(
            $this->getOrder(),
            $this->getFilter(),
            $this->getGroupBy(),
            $this->getNavParams(),
            $this->getSelect()
        );
    }

    public function getCount(): int
    {
        $this->withGroupBy([]);

        $this->expandFilter(['IBLOCK_ID' => $this->getIBlockId()]);

        $CIBlockElement = new CIBlockElement();
        return $CIBlockElement->GetList($this->order, $this->filter, $this->groupBy);
    }

    public function add($fields): int
    {
        $fields = array_merge(
            [
                'ACTIVE' => 'Y',
                'IBLOCK_ID' => $this->getIBlockId(),
            ],
            $fields
        );

        $CIBlockElement = new CIBlockElement();

        $result = $CIBlockElement->Add($fields);

        if (!$result) {
            throw new Exception($CIBlockElement->LAST_ERROR);
        }

        return $result;
    }
}
