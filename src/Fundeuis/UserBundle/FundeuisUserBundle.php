<?php

namespace Fundeuis\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FundeuisUserBundle extends Bundle
{
       public function getParent()
    {
	return 'FOSUserBundle';
    }
}
