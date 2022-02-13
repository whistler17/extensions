<?php

namespace Itgro\Entity\IBlock\Section;

use Itgro\CanCreatedAsEntity;

class Entity extends Base
{
    use CanCreatedAsEntity;

    public function setUserFields()
    {
        global $USER_FIELD_MANAGER;

        $userFields = $USER_FIELD_MANAGER->GetUserFields(
            sprintf('IBLOCK_%s_SECTION', $this->getIBlockId()),
            $this->id()
        );

        foreach ($userFields as $userField) {
            $this->setField($userField['FIELD_NAME'], $userField['VALUE']);
        }
    }
}
