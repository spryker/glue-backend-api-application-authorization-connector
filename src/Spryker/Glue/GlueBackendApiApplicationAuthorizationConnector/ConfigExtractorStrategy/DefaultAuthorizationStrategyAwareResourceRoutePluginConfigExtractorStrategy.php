<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\RouteAuthorizationConfigTransfer;
use Spryker\Glue\GlueApplicationAuthorizationConnectorExtension\Dependency\Plugin\DefaultAuthorizationStrategyAwareResourceRoutePluginInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface;

class DefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy implements ConfigExtractorStrategyInterface
{
    public function isApplicable(ResourceInterface $resource): bool
    {
        return $resource instanceof DefaultAuthorizationStrategyAwareResourceRoutePluginInterface;
    }

    public function extractRouteAuthorizationConfigTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        ResourceInterface $resource
    ): ?RouteAuthorizationConfigTransfer {
        $defaultAuthorizationStrategyAwareResourceRoutePlugin = $resource;

        /** @phpstan-ignore method.notFound */
        return $defaultAuthorizationStrategyAwareResourceRoutePlugin->getRouteAuthorizationDefaultConfiguration();
    }
}
