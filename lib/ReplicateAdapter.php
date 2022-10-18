<?php

namespace League\Flysystem\Replicate;

use Ajgl\Flysystem\Replicate\ReplicateAdapter as AjglReplicateAdapter;
use League\Flysystem\AdapterInterface;

/**
 * @deprecated
 */
class ReplicateAdapter extends AjglReplicateAdapter
{
    /**
     * {@inheritdoc}
     */
    public function __construct(AdapterInterface $source, AdapterInterface $replica)
    {
        @trigger_error('Since ajgl/flysystem-replicate 1.0.2: The "League\Flysystem\Replicate\ReplicateAdapter" class is deprecated, use "Ajgl\Flysystem\Replicate\ReplicateAdapter" instead.', \E_USER_DEPRECATED);
        $this->source = $source;
        $this->replica = $replica;
    }
}
