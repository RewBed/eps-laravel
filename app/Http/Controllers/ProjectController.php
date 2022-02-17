<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Количество проектов на странице
     *
     * @var int
     */
    private int $projectsOnPage = 15;

    /**
     * Создание объекта
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request) : JsonResponse {
        $validated = $request->validate([
            'name' => ['required', 'filled', 'max:255'],
            'comment' => ['max:65535'],
            'statusID' => ['required', 'integer'],
            'authorID' => ['required', 'integer']
        ]);

        $project = new Project();
        $project->fill($validated);

        if($project->save())
            return response()->json(['project' => $project]);

        return response()->json(['error' => '']);
    }

    /**
     * Обновление проекта
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['filled', 'max:255'],
            'comment' => ['max:65535'],
            'statusID' => ['integer'],
            'authorID' => ['integer']
        ]);

        $project = Project::findOrFail($validated['id']);
        $project->fill($validated);
        $project->save();

        return response()->json(['project' => $project]);
    }

    /**
     * Удалить проект
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function delete(int $projectID): JsonResponse
    {
        $project = Project::findOrFail($projectID);
        return response()->json(['delete' => $project->delete()]);
    }

    /**
     * Экземпляр проекта
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function item(int $projectID) : JsonResponse {
        return response()->json(['project' => Project::findOrFail($projectID)]);
    }

    /**
     * Список проектов
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse {
        $projects = Project::paginate($this->projectsOnPage);
        return response()->json(['projects' => $projects]);
    }
}
