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
        @trigger_error(sprintf('Since ajgl/flysystem-replicate 1.0.2: The "%s" class is deprecated, use "%s" instead.', self::class, AjglReplicateAdapter::class), \E_USER_DEPRECATED);
        $this->source = $source;
        $this->replica = $replica;
    }
}
