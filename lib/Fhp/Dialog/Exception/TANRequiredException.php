<?php

namespace Fhp\Dialog\Exception;

use Fhp\Dialog\Dialog;
use Fhp\Message\Message;
use Fhp\Response\GetTANRequest;

class TANRequiredException extends \Exception
{
    const TAN_TOKEN_VALUE_ORDER = ['processId', 'systemId', 'dialogId', 'messageNumber', 'tanMechanism', 'tanMediaName'];

    /** @var string */
    protected $tanMechanism;
    /** @var string|null */
    protected $tanMediaName = null;
    /** @var string */
    protected $systemId;
    /** @var string */
    protected $dialogId;
    /** @var int */
    protected $messageNumber;
    /** @var string */
    protected $processId;

    /** @var Message */
    protected $cause;

    /** @var GetTANRequest */
    protected $response;

    public function __construct(GetTANRequest $response, Message $cause, Dialog $dialog)
    {
        $this->response = $response;
        $this->cause = $cause;
        $this->tanMechanism = $cause->getSecurityFunction();
        $this->tanMediaName = $response->getTanMediumName();

        $this->systemId = $dialog->getSystemId();
        $this->dialogId = $dialog->getDialogId();
        $this->messageNumber = $dialog->getMessageNumber();
        $this->processId = $response->get()->getProcessID();

        parent::__construct($response->getTanChallenge());
    }

    /**
     * @return GetTANRequest
     */
    public function getResponse(): GetTANRequest
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getTanMechanism(): string
    {
        return $this->tanMechanism;
    }

    /**
     * @return string|null
     */
    public function getTanMediaName(): ?string
    {
        return $this->tanMediaName;
    }

    /**
     * @return string
     */
    public function getSystemId(): string
    {
        return $this->systemId;
    }

    /**
     * @return string
     */
    public function getDialogId(): string
    {
        return $this->dialogId;
    }

    /**
     * @return int
     */
    public function getMessageNumber(): int
    {
        return $this->messageNumber;
    }

    /**
     * @return string
     */
    public function getProcessId(): string
    {
        return $this->processId;
    }

    /**
     * Konkateniert die benötigten Wert mit Tilde (~),
     * da Tilde nicht im FinTS-Basiszeichensatz enthalten ist und somit nicht in einem
     * dieser Wert vorkommen kann und ~ außerdem URL-Safe ist.
     *
     * @return string
     */
    public function getTANToken(): string
    {
        $values = [];
        foreach (self::TAN_TOKEN_VALUE_ORDER as $name) {
            $values[] = $this->$name;
        }
        return implode('~', $values);
    }
}
