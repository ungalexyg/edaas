<?php

/**
 * --------------------------------------------------------------------------
 *  Enums Contracts
 * --------------------------------------------------------------------------
 * 
 * The Enums Contracts created to handle cases where the same set of enums required in several
 * places so the set can be reused.
 * 
 * In all those cases the contracts should be implemented by the Enum class 1st, 
 * to keep prisistant aggregation of Enums in the app then it can be used in additional classes.
 * 
 * In this way, classes can perform action based on relevant Enum without loading 
 * the class and the Enum together everywhare. 
 * And, still all the Enums in the app are visible in single Enum directory.   
 * 
 * (the ideal is to accomplish it with traits, but traits cannot have constants) 
 * 
 * e.g :
 * 
 * single class loaded once and own the enums, the same enums exists in App\Enums\LogsEnum 
 * 
 * Log::channel(Log::PROCESS)  
 * 
 * Act::channel(Act::ACTION)  
 * 
 */ 