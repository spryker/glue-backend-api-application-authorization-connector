<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\RouteAuthorizationConfigTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface;

class GenericResourceAuthorizationConfigExtractorStrategy implements ConfigExtractorStrategyInterface
{
    /**
     * @var string
     */
    protected const STRATEGIES_AUTHORIZATION = '_authorization_strategies';

    public function isApplicable(ResourceInterface $resource): bool
    {
        return true;
    }

    public function extractRouteAuthorizationConfigTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        ResourceInterface $resource
    ): ?RouteAuthorizationConfigTransfer {
        if ($glueRequestTransfer->getResource() === null) {
            return null;
        }

        $authorizationStrategies = $this->getAuthorizationStrategies($glueRequestTransfer->getResourceOrFail());
        if ($authorizationStrategies === []) {
            return null;
        }

        return (new RouteAuthorizationConfigTransfer())
            ->setStrategies($authorizationStrategies);
    }

    /**
     * @param \Generated\Shared\Transfer\GlueResourceTransfer $glueResourceTransfer
     *
     * @return array<string>
     */
    protected function getAuthorizationStrategies(GlueResourceTransfer $glueResourceTransfer): array
    {
        $routeParameters = $glueResourceTransfer->getParameters();
        $authorizationStrategies = $routeParameters[static::STRATEGIES_AUTHORIZATION] ?? [];

        return (array)$authorizationStrategies;
    }
}
