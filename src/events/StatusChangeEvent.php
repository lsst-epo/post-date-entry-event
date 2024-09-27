<?php

namespace putyourlightson\elementstatusevents\events;

use craft\base\Element;
use craft\base\ElementInterface;
use craft\elements\Entry;
use yii\base\Event;

class StatusChangeEvent extends Event
{
    // Properties
    // =========================================================================

    /**
     * @var ElementInterface|null The element model associated with the event.
     */
    public $element;

    /**
     * @var string Previous status
     */
    public $statusBeforeSave = '';

    // Public Methods
    // =========================================================================

    /**
     * @param string $nameOfStatus
     *
     * @return bool
     */
    public function changedTo(string $nameOfStatus): bool
    {
        return ($this->element->getStatus() === $nameOfStatus);
    }

    /**
     * @return bool
     */
    public function changedToPublished(): bool
    {
       return in_array($this->element->getStatus(), [Entry::STATUS_LIVE, Element::STATUS_ENABLED]);
    }

    /**
     * @return bool
     */
    public function changedToUnpublished(): bool
    {
        return !$this->changedToPublished();
    }

    /**
     * @return ElementInterface|null
     */
    public function getElement()
    {
        return $this->element;
    }
}
