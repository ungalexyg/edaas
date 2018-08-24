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
 *  -- IMainProcessor extends IProcess [run(), process()]
 *  -- IProcessor extends IProcess [load(), process()]
 *  -- IScaner extends IProcess [handle(), scan()]     
 *  -- IKeepr extends IProcess  [handle(), keep()]     
 *  -- IPublisher extends IProcess [handle(), watch()]
 * 
 */ 


/**
 * --------------------------------------------------------------------------
 *  Processors
 * --------------------------------------------------------------------------
 * 
 * The processors manage specific process flow operation using different types of child instances.
 */ 


/**
 * --------------------------------------------------------------------------
 *  Scanners
 * --------------------------------------------------------------------------
 * 
 * The Scanners scan "Prospect Items" from given "Prospects Channels" using Adapters, then pass them to the Keeperes to store them and wait for forther handling.
 */ 


 /**
 * --------------------------------------------------------------------------
 *  Keepers
 * --------------------------------------------------------------------------
 * 
 * The Keepers collect, organise & store the data into the storge DB.
 */ 


/**
 * --------------------------------------------------------------------------
 *  Publishers
 * --------------------------------------------------------------------------
 * 
 * The Publishers grab stored data from the storage DB & publish it into the public tables which display data in the app.
 */ 


 /**
 * --------------------------------------------------------------------------
 *  Observers
 * --------------------------------------------------------------------------
 * 
 * The Observers Observing the prospect items, tracking, comparing & mark their performance according to set of conditions across mutiple channels.
 * The Observers are Laravel native classes so they are located in their native path App/Observers.
 */ 






