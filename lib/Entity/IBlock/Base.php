<?php

namespace Itgro\Entity\IBlock;

use Bitrix\Main\Loader;
use CDBResult;
use CIBlockElement;
use Exception;
use Itgro\Bitrix\Admin\WithAdditionalExtensions;
use Itgro\Entity\Base as BaseEntity;

abstract class Base extends BaseEntity
{
    use WithEvents;
    use WithRandomShow;
    use WithAdditionalExtensions;

    protected $iBlockCode;

    public function __construct()
    {
        try {
            check_modules('iblock');

            if (empty($this->iBlockCode)) {
                throw new Exception('Поле iBlockCode должно быть заполнено');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getIBlockId()
    {
        return get_iblock_id($this->getIBlockCode());
    }

    public function getIBlockCode()
    {
        return $this->iBlockCode;
    }

    protected function expandOneItemParameters()
    {
        $this->expandNavParams(['nTopCount' => 1]);
    }

    abstract public function getCount();

    abstract public function add($fields);
}
