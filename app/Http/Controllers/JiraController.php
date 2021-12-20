<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueCreateRequest;
use App\Http\Requests\ProjectCreateRequest;
use App\Services\JiraService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class JiraController
 * @package App\Http\Controllers
 */
class JiraController extends Controller
{
    /**
     * @var JiraService
     */
    private $jiraService;

    /**
     * JiraController constructor.
     * @param JiraService $jiraService
     */
    public function __construct(JiraService $jiraService)
    {
        $this->jiraService = $jiraService;
        
    }

    /**
     * @param ProjectCreateRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createProject(ProjectCreateRequest $request): JsonResponse
    {
        $response = $this->jiraService->createProject($request->all());
        return response()->json($response);
    }

    /**
     * @param IssueCreateRequest $request
     * @return JsonResponse
     * @throws \JsonMapper_Exception
     */
    public function createIssue(IssueCreateRequest $request): JsonResponse
    {
        $response = $this->jiraService->createIssue($request->all());
        return response()->json($response);
        
    }
}
