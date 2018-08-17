<?php 



#######################################
# Processes
#######################################

/**
 * --------------------------------------------------------------------------
 *  Architecture
 * --------------------------------------------------------------------------
 * 
 * Interfaces : 
 * 
 * - IProcess [pull(), push()]
 *  -- IProcessor extends IProcess [load(), process()]
 *  -- IScaner extends IProcess [handle(), scan()]     
 *  -- IKeepr extends IProcess  [handle(), keep()]     
 *  -- IWatcher extends IProcess [handle(), watch()]
 * 
 */ 


/**
 * --------------------------------------------------------------------------
 *  Processor
 * --------------------------------------------------------------------------
 * 
 * Manage specific process operation using different types of child instances
 * 
 */ 



/**
 * --------------------------------------------------------------------------
 *  Scanner
 * --------------------------------------------------------------------------
 * 
 * Locat "Prospect Items" from given "Prospects Channels" & store them in "Propects Q" for forther handling by the Watcher.
 * 
 * Prospects Channels :
 *  start with Ali
 * 
 * TODO: Ali adapter
 * 
 */ 


 /**
 * --------------------------------------------------------------------------
 *  Watcher
 * --------------------------------------------------------------------------
 * 
 * The Watcher whatching the prospect items, tracking, comparing & mark their performance according to set of conditions across mutiple channels.
 * 
 * TODO: write the conditions
 * 
 */ 


 /**
 * --------------------------------------------------------------------------
 *  Keeper
 * --------------------------------------------------------------------------
 * 
 * The Keeper collect, organise & transform the data into api stactured records.
 * 
 */ 




