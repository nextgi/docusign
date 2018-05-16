<?php namespace Nextgi\Docusign\Traits;

use Docusign;
use Illuminate\Support\Facades\Config;

trait Envelope {

    public function envelope()
    {
        return Docusign::getEnvelope($this->getEnvelopeId());
    }

    public function recipients()
    {
        return Docusign::getEnvelopeRecipients($this->getEnvelopeId());
    }

    public function tabs($recipientId)
    {
        return Docusign::getEnvelopeTabs($this->getEnvelopeId(), $recipientId);

    }

    public function void($reason)
    {
        $this->status = 'voided';
        return Docusign::updateEnvelope($this->getEnvelopeId(), array(
            'status' => $this->status,
            'voidedReason' => $reason
        ));
    }

    protected function getEnvelopeId()
    {
        return $this->{Config::get('docusign.envelope_field')};
    }

} 