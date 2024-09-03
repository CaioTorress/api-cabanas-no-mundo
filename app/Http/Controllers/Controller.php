<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Traits\QueryParameters;

abstract class Controller
{
    use ApiResponse, QueryParameters;

        /**
     * Except params from request for paginate.
     *
     * @var array
     */
    protected $requestExcept = [
        'search',
        'limit', 
        'order_by', 
        'order', 
        'page', 
        'count', 
        'current_page', 
        'last_page', 
        'next_page_url', 
        'per_page', 
        'previous_page_url', 
        'total', 
        'url', 
        'from', 
        'to', 
        'registerActive', 
    ];

    protected $Paginated = false;

    /**
     * Array of params to filter queries
     */
    protected array $queryStrings;

    protected $limit;
    protected $order_by;
    protected $order;
    protected $hasRegisterActive;


    public function __construct()
    {
        if(request()->header('Paginated'))
            $this->Paginated = true;

        if (request()->isMethod('get'))
            $this->getQueriesparameters();
        
    }

    private function getQueriesparameters()
    {
        $this->queryStrings = request()->except($this->requestExcept);
    
        $this->limit                = request()->input('limit')         ?? '10';
        $this->order_by             = request()->input('order_by')      ?? 'id';
        $this->order                = request()->input('order')         ?? 'desc';

        if ($this->limit >= 100)
            $this->limit = 100;

    }
}
