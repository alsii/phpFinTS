<?php /** @noinspection PhpUnused */

namespace Fhp\Segment\HITANS;

use Fhp\Segment\BaseDeg;

class VerfahrensparameterZweiSchrittVerfahrenV1 extends BaseDeg implements VerfahrensparameterZweiSchrittVerfahren
{
    /** @var integer Allowed values: 900 through 997 */
    public $sicherheitsfunktion;
    /** @var integer Allowed values: 1, 2, 3, 4; See specification for details */
    public $tanProzess;
    /** @var string */
    public $technischeIdentifikationTanVerfahren;
    /** @var string Max length: 30 */
    public $nameDesZweiSchrittVerfahrens;
    /** @var integer */
    public $maximaleLaengeDesTanEingabewertes;
    /** @var integer Allowed values: 1 = numerisch, 2 = alfanumerisch */
    public $erlaubtesFormat;
    /** @var string */
    public $textZurBelegungDesRueckgabewertes;
    /** @var integer Allowed values: 1 through 256 */
    public $maximaleLaengeDesRueckgabewertes;
    /** @var integer|null */
    public $anzahlUnterstuetzterAktiverTanListen;
    /** @var boolean */
    public $mehrfachTanErlaubt;
    /** @var boolean */
    public $tanZeitversetztDialoguebergreifendErlaubt;

    /** @inheritDoc */
    public function getId()
    {
        return $this->sicherheitsfunktion;
    }

    /** @inheritDoc */
    public function getName()
    {
        return $this->nameDesZweiSchrittVerfahrens;
    }

    /** @inheritDoc */
    public function getSmsAbbuchungskontoErforderlich()
    {
        return false;
    }

    /** @inheritDoc */
    public function getAuftraggeberkontoErforderlich()
    {
        return false;
    }

    /** @inheritDoc */
    public function getChallengeKlasseErforderlich()
    {
        return false;
    }

    /** @inheritDoc */
    public function getAntwortHhdUcErforderlich()
    {
        return false;
    }

    /** @inheritDoc */
    public function getChallengeLabel()
    {
        return $this->textZurBelegungDesRueckgabewertes;
    }

    /** @inheritDoc */
    public function getMaxChallengeLength()
    {
        return $this->maximaleLaengeDesRueckgabewertes;
    }

    /** @inheritDoc */
    public function getMaxTanLength()
    {
        return $this->maximaleLaengeDesTanEingabewertes;
    }

    /** @inheritDoc */
    public function getTanFormat()
    {
        return $this->erlaubtesFormat;
    }

    /** @inheritDoc */
    public function needsTanDevice()
    {
        return false;
    }
}
