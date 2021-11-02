<?php


namespace App\Services;

use Exception;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;
use JiraRestApi\Project\Project;
use JiraRestApi\Project\ProjectService;
use JiraRestApi\User\UserService;

/**
 * Class JiraService
 * @package App\Services
 */
class JiraService
{
    /**
     * @var array
     */
    protected array $templates = [
        'business' => 'com.atlassian.jira-core-project-templates:jira-core-project-management',
        'software' => 'com.atlassian.jira-software-project-templates:jira-software-project-management'
    ];

    /**
     * @param $data
     * @return array
     * @throws Exception
     */
    public function createProject(array $data): array
    {
        try {
            $project = new Project();
            $project->setKey($data['key'])
                ->setName($data['name'])
                ->setProjectTypeKey($data['project_type'])
                ->setProjectTemplateKey($this->templates[$data['project_type']])
                ->setDescription($data['description'])
                ->setUrl($data['url'])
                ->setAssigneeType(isset($data['assign']) ? $data['assign'] : 'UNASSIGNED')
                ->setLeadAccountId($data['account_id'])
                ->setAvatarId($data['avatar_id']);
            $projectService = new ProjectService();
            $result = $projectService->createProject($project);

            return [
                'success' => 1,
                'type'    => 'success',
                'link'    => $result->self
            ];
        } catch (JiraException $exception) {
            $error = json_decode($exception->getResponse(), true);

            return [
                'success' => 0,
                'type'    => 'error',
                'message' => isset($error['errorMessages'][0]) ? $error['errorMessages'][0] : $exception->getMessage()
            ];
        }
    }

    /**
     * @param string $key
     * @return bool
     * @throws JiraException
     */
    private function checkProjectKeyExist(string $key): bool
    {
        $projectService = new ProjectService();
        $projects = $projectService->getAllProjects();
        foreach ($projects as $project) {
            if ($key === $project->key) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $data
     * @return array
     * @throws \JsonMapper_Exception
     */
    public function createIssue(array $data): array
    {
        try {
            if (!$this->checkProjectKeyExist($data['key'])) {
                return [
                    'success' => 0,
                    'type'    => 'error',
                    'message' => "Project with {$data['key']} does not exist."
                ];
            }

            $issue = new IssueField();
            $issue->setProjectKey($data['key'])
                ->setSummary($data['summary'])
                ->setIssueType("Task")
                ->setDescription($data['description']);

            if (isset($data['due_date'])) {
                $issue->setDueDate($data['due_date']);
            }
            if (isset($data['priority'])) {
                $issue->setPriorityName($data['priority']);
            }
            $issueService = new IssueService();
            $result = $issueService->create($issue);

            return [
                'success' => 1,
                'type'    => 'success',
                'link'    => $result->self
            ];
        } catch (JiraException $exception) {
            $error = json_decode($exception->getResponse(), true);

            return [
                'success' => 0,
                'type'    => 'error',
                'message' => isset($error['errorMessages'][0]) ? $error['errorMessages'][0] : $exception->getMessage()
            ];
        }
    }
}
