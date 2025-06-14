<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use App\Models\Category;
use App\Models\Event;
use App\Models\Project;

class ViewController extends Controller
{
    private function updateSubmitted(){
        $date = Event::orderBy('date_ceremony', 'desc')->value('date_ceremony'); 

        if ($date && \Carbon\Carbon::parse($date)->lessThan(now())) {
            Project::where('status', '!=', 'COMPLETED')
                ->update(['status' => 'COMPLETED']);
        }
    }
    public function dashboard(){
        if (auth()->user()->isAdmin()) {
            $categories = DB::table('categories')
            ->select('*')
            ->get();
            $events = DB::table('events')
            ->select('*')
            ->get();
            $projects = DB::table('projects')
            ->select('*')
            ->get();
            return view('admin.dashboard', compact('categories','events', 'projects'));
        }
        $events = DB::table('events')
        ->select('*')
        ->get();

        $projects = DB::table('projects')
        ->join('categories', function (JoinClause $join) {
            $join->on('projects.category_id', '=', 'categories.id')
            ->where('projects.user_id', '=',\Illuminate\Support\Facades\Auth::user()->id);})
        ->select('projects.id as ProID', 'projects.title', 'projects.status', 'projects.publication', 'projects.receipt',
                    'projects.category_id', 'categories.fee', 'categories.currency')
        ->get();

        $draft = DB::table('projects')
        ->where('status','=','DRAFT')
        ->count('status');

        $submitted = DB::table('projects')
        ->where('status','=','SUBMITTED')
        ->count('status');

        $this->updateSubmitted();

        return view('contestant.dashboard', compact('events','projects','draft','submitted'));
    }

    public function view_add(){
        $categories = DB::table('categories')
        ->select('*')
        ->get();

        $events = DB::table('events')
        ->select('*')
        ->get();

        $this->updateSubmitted();

        return view('contestant.project',compact('categories','events'));
    }

    public function view_edit($id){
        $categories = DB::table('categories')
        ->select('*')
        ->get();

        $events = DB::table('events')
        ->select('*')
        ->get();

        $project = DB::table('projects')
        ->join('categories', function (JoinClause $join) use ($id) {
            $join->on('projects.category_id', '=', 'categories.id')
                 ->where('projects.id', '=', $id);
        })
        ->select('projects.id as ProID', 'projects.title', 'projects.status', 'projects.abstract', 'projects.leader', 'projects.organisation',
                    'projects.address', 'projects.email', 'projects.phone', 'projects.member1', 'projects.member2', 'projects.member3', 
                    'projects.member4', 'projects.publication', 'projects.link', 'projects.user_id', 'projects.event_id', 'projects.category_id as cat_id', 'categories.fee as cat_fee',
                    'categories.name as cat_name', 'projects.technical_paper')
        ->first();
        
        $this->updateSubmitted();

        return view('contestant.project',compact('project','categories','events'));
    }

    public function view_repository(){
        $projects = DB::table('projects')
        ->select('*')
        ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)
        ->get();

        $this->updateSubmitted();

        return view('contestant.repository', compact('projects'));
    }

    public function view_events(){
        $events = Event::all();

        $this->updateSubmitted();

        return view('admin.events',compact('events'));
    }
    
    public function view_categories(){
        $categories = Category::all();

        $this->updateSubmitted();

        return view('admin.categories',compact('categories'));
    }
    
    public function view_details($id){
        $project = DB::table('projects')
        ->join('categories', function (JoinClause $join) use ($id) {
            $join->on('projects.category_id', '=', 'categories.id')
                 ->where('projects.id', '=', $id);
        })
        ->select('projects.id as ProID', 'projects.title', 'projects.status', 'projects.abstract', 'projects.leader', 'projects.organisation',
                    'projects.address', 'projects.email', 'projects.phone', 'projects.member1', 'projects.member2', 'projects.member3', 
                    'projects.member4', 'projects.publication', 'projects.link', 'projects.user_id', 'projects.event_id', 'projects.category_id as cat_id', 'categories.fee as cat_fee',
                    'categories.name as cat_name', 'projects.technical_paper')
        ->first();

        $this->updateSubmitted();

        return view('admin.details',compact('project'));
    }
    
    public function view_payment(Request $request){
        $project = DB::table('projects')
        ->join('categories', function (JoinClause $join) use ($request) {
            $join->on('projects.category_id', '=', 'categories.id')
                 ->where('projects.id', '=', $request->id);
        })
        ->select('categories.fee as cat_fee', 'projects.id', 'projects.link', 'categories.currency')
        ->first();

        $publication = DB::table('projects')
        ->select('publication')
        ->where('id','=',$request->id)
        ->first();

        $publicationValue = $publication->publication;
        return view('contestant.payment', compact(  'project', 'publicationValue'));
    }

    public function view_information(){
        $categories = DB::table('categories')
        ->select('*')
        ->get();

        $events = DB::table('events')
        ->select('*')
        ->get();

        $this->updateSubmitted();

        return view('contestant.information',compact('categories','events'));
    }
}