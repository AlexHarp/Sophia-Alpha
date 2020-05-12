<?php 

namespace Drupal\neptune_sync\querier;


use Drupal\neptune_sync\Utility\Helper;

/**
 * Class QueryManager
 * @package Drupal
 * @author Alexis Harper | DoF
 * A class for running SPAQRL querier from drupal to neptune, leaving a file
 * for feeds to read and import the query results. all query calls should go
 * through this class
 */
class QueryManager
{
    protected $query;

    public function __construct(){
        QueryTemplate::init();
    }

    /**
     * Creates json files based on SPARQL queries ready to import into
     * drupal via feeds
     */
    public function syncAllDatasets(){
        /*
        XXX: do we need labels?
        Helper::log('running sync all');
        $q = QueryTemplate::$queries['getLabels'];
        $this->runQuery($q);*/

        Helper::log('Sync all, syncing legsislations');
        $q = QueryTemplate::$queries['getLegislations'];
        $this->runQuery($q);

        Helper::log('legislation complete, syncing bodies');
        $q = QueryTemplate::$queries['getBodies'];
        $this->runQuery($q);

        Helper::log('bodies synced, sync complete');
    }

    /**
     * Separated from run query for encapsulation principles despite having similar
     * functionality
     * @param $query query
     *      The query to execute
     */
    public function runCustomQuery($query){
        $this->runQuery($query);
    }

    /**
     * Executes a SPARQL query
     * 2>&1 | tee  (https://www.php.net/manual/en/function.shell-exec.php) must
     * be used to clear sterr which will halt shell_exec if not placed
     * @param $query
     *      The SPARQL query to wrap the execute command around
     */
    protected function runQuery($query){
        $cmd = 'curl -s -X POST --data-binary \'query=' . $query->getQuery() . '\' '
                . $query->getDestination() . " 2>&1 | tee " . $query->getOutputPath();
        $res = shell_exec($cmd);
        \drupal::logger('neptune_sync')->notice("executed command: " . $cmd . "\nResults: " . $res);
    }
}

    
