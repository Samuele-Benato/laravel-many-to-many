<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $technologies = Technology::orderBy('label')->get();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'project', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        $project = new Project;
        $project->fill($data);
        $project->save();

        if (Arr::exists($data, "technologies"))
            $project->technologies()->attach($data["technologies"]);
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::orderBy('label')->get();
        $project_technologies = $project->technologies->pluck('id')->toArray();


        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'project_technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all());
        $project->update($data);
        if (Arr::exists($data, "technologies"))
            $project->technologies()->sync($data["technologies"]);
        else
            $project->technologies()->detach();
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'title' => 'required|string|max:20',
                'link' => "required",
                "image" => "required",
                "type_id" => "required",
                "technologies" => 'exists:technologies,id|nullable',
                'description' => "required",
            ],
            [
                'title.required' => 'Il nome è obbligatorio',
                'title.string' => 'Il nome deve essere una stringa',
                'title.max' => 'Il nome deve massimo di 20 caratteri',

                'link.required' => 'il link è obbligatorio',

                'image.required' => 'L\'immagine è obbligatoria',

                'type_id.required' => 'Il tipo è obbligatorio',
                'technologies.exists' => 'le technologie inserite non sono valide',
                'description.required' => 'La descrizione è obbligatoria',

            ]
        )->validate();

        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::orderByDesc('id')->onlyTrashed()->paginate(5);
        return view('admin.projects.trash.index', compact('projects'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.trash.index');
    }

    /**
     * restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('admin.projects.trash.index');
    }
}