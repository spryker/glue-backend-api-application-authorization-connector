<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\RouteAuthorizationConfigTransfer;
use Spryker\Glue\GlueApplicationAuthorizationConnectorExtension\Dependency\Plugin\AuthorizationStrategyAwareResourceRoutePluginInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface;

class AuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy implements ConfigExtractorStrategyInterface
{
    public function isApplicable(ResourceInterface $resource): bool
    {
        return $resource instanceof AuthorizationStrategyAwareResourceRoutePluginInterface;
    }

    public function extractRouteAuthorizationConfigTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        ResourceInterface $resource
    ): ?RouteAuthorizationConfigTransfer {
        $method = $glueRequestTransfer->getMethodOrFail();

        $authorizationStrategyAwareResourceRoutePlugin = $resource;

        /** @phpstan-ignore method.notFound */
        $routeAuthorizationConfigTransfers = $authorizationStrategyAwareResourceRoutePlugin->getRouteAuthorizationConfigurations();

        return $routeAuthorizationConfigTransfers[$method] ?? null;
    }
}
