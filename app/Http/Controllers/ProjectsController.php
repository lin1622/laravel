<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
            $projects = Project::where('user_id',Auth::user()->id)->get();

            return view('projects.index',['projects' => $projects]);
        }

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $company_id = null )
    {
        //
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id'=>$company_id,'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('project_id'),
                'user_id' =>Auth::user()->id
            ]);

            if($project){
                return redirect()->route('projects.show' , ['project' => $project->id])
                    ->with('success' , '项目创建成功');
            }
        }

        //redirect
        return back()->withInput()->with('errors' , '创建失败 ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $project = Project::find($project -> id);
        $comments = $project->comments;
        return view('projects.show', ['project'=>$project, 'comments'=> $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id );

        return view('projects.edit', ['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data

        $projectUpdate = Project::where('id', $project->id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

        if($projectUpdate){
            return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success','更新成功');
        }

        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $findproject = Project::find( $project->id);
        if($findproject->delete()){

            //redirect
            return redirect()->route('projects.index')
                ->with('success' , 'project deleted successfully');
        }

        return back()->withInput()->with('error' , 'project could not be deleted');

    }
}
