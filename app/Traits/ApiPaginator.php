<?php

namespace App\Traits;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiPaginator {

	/**
	* Get Paginator form LengthAwarePaginator object
	* @param LengthAwarePaginator
	* @return \Illuminate\Http\JsonResponse
	*/
	public function getPaginator(LengthAwarePaginator $paginatedObject){
		$paginatedArray = $paginatedObject->toArray();
		$paginator['links']['first_page_url'] = $paginatedArray['first_page_url'];
		$paginator['links']['last_page_url'] = $paginatedArray['last_page_url'];
		$paginator['links']['next_page_url'] = $paginatedArray['next_page_url'];
		$paginator['links']['prev_page_url'] = $paginatedArray['prev_page_url'];
		$paginator['meta']['path'] = $paginatedArray['path'];
		$paginator['meta']['current_page'] = $paginatedArray['current_page'];
		$paginator['meta']['from'] = $paginatedArray['from'];
		$paginator['meta']['per_page'] = $paginatedArray['per_page'];
		$paginator['meta']['to'] = $paginatedArray['to'];
		$paginator['meta']['total'] = $paginatedArray['total'];
		return $paginator;
	}

	/**
	* Return Paginated json response
	*
	* @param Illuminate\Pagination\LengthAwarePaginator
	* @param Illuminate\Http\Resources\Json\ResourceCollection
	* @return array
	*/

	public function getPaginatedResponse(LengthAwarePaginator $paginatedObject, ResourceCollection $resourceCollection) {
		$paginator = $this->getPaginator($paginatedObject);
		return[
			'data' => $resourceCollection,
			'links' => $paginator['links'],
			'meta' => $paginator['meta']
		];
	}
}

?>
