
<?php

/**
 * --------------------------------------------------------------------------
 *  Description 
 * --------------------------------------------------------------------------
 * 
 * This directory conatins copies of useful pieces of code.
 * Some of them are implemented in the application but 
 * not directly via the version in this directory.
 * 
 */


 /**
 * --------------------------------------------------------------------------
 *  Guidelines
 * --------------------------------------------------------------------------
 *  
 *  # PHP standarts
 *  https://www.php-fig.org/psr/psr-2/
 * 
 *  
 *  # Main vs Base
 *  
 *  MainClass - 
 *  load child instnaces, typically is also [final] becuase it should not be extended, 
 *  it is not a parent, it the central manager  that accessed directly to initiate & run a process. 
 *  
 *  BaseClass - 
 *  parent to child instnaces, typically is also [abstract] & [implements] an interface becuase all the childs should have common functionality.
 * 
 */

