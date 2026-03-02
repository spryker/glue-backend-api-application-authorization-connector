<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Dependency\Facade;

use Generated\Shared\Transfer\AuthorizationRequestTransfer;
use Generated\Shared\Transfer\AuthorizationResponseTransfer;

class GlueBackendApiApplicationAuthorizationConnectorToAuthorizationFacadeBridge implements GlueBackendApiApplicationAuthorizationConnectorToAuthorizationFacadeInterface
{
    /**
     * @var \Spryker\Zed\Authorization\Business\AuthorizationFacadeInterface
     */
    protected $authorizationFacade;

    /**
     * @param \Spryker\Zed\Authorization\Business\AuthorizationFacadeInterface $authorizationFacade
     */
    public function __construct($authorizationFacade)
    {
        $this->authorizationFacade = $authorizationFacade;
    }

    public function authorize(AuthorizationRequestTransfer $authorizationRequestTransfer): AuthorizationResponseTransfer
    {
        return $this->authorizationFacade->authorize($authorizationRequestTransfer);
    }
}
