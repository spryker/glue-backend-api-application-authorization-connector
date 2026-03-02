<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Glue\GlueBackendApiApplicationAuthorizationConnector\Stub;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\RouteAuthorizationConfigTransfer;
use Spryker\Glue\GlueApplicationAuthorizationConnectorExtension\Dependency\Plugin\AuthorizationStrategyAwareResourceRoutePluginInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface;
use stdClass;

class TestAuthorizationStrategyAwareResourceRoutePlugin implements AuthorizationStrategyAwareResourceRoutePluginInterface, ResourceInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\RouteAuthorizationConfigTransfer>
     */
    public function getRouteAuthorizationConfigurations(): array
    {
        $routeAuthorizationConfigTransfer = (new RouteAuthorizationConfigTransfer())->addStrategy('test');

        return [
            'get' => $routeAuthorizationConfigTransfer,
        ];
    }

    public function getResource(GlueRequestTransfer $glueRequestTransfer): callable
    {
        return [
            new stdClass(),
            'method',
        ];
    }

    public function getType(): string
    {
        return 'test';
    }

    public function getController(): string
    {
        return 'FooController';
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return new GlueResourceMethodCollectionTransfer();
    }
}
