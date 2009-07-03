<?php

/* (C) 2009 Netology Joy Web Framework, All rights reserved.
 *
 * Author(s):
 *   Hasan Ozgan (meddah@netology.org)
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import("joy.web.Attribute");

class joy_web_attributes_Charset extends joy_web_Attribute
{
    public function Execute()
    {
        $this->Logger->Debug("Attribute Charset", __FILE__, __LINE__);
    }
}

?>
