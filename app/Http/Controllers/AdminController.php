<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectExport;
use App\Exports\ProjectAward;
use App\Models\Category;
use App\Models\Event;
use App\Imports\AdminImport;

class AdminController extends Controller
{
    public function downloadPDF(){
        $projects = DB::table('projects')
        ->select('*')
        ->get();
        $data = [
            'title' => 'Project List',
            'date' => date('m/d/Y'),
            'projects' => $projects
        ];
        $pdf = PDF::loadView('admin.myPDF', $data)->setPaper('a4','landscape');
        return $pdf->download('projects.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new ProjectExport, 'total-projects-idrive.xlsx');
    }

    public function downloadExcel2()
    {
        return Excel::download(new ProjectAward, 'idrive-awards-list.xlsx');
    }

    
    public function edit_categories(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'fee' => 'required|numeric',
            'currency' => 'required|string'
        ]);

        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->fee = $request->fee;
            $category->currency = $request->currency;
            $category->save();
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function delete_categories($id){
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function add_categories(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'fee' => 'required|numeric',
            'currency' => 'required|string'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->fee = $request->fee;
        $category->currency = $request->currency;
        $category->save();

        return redirect()->back()->with('success', 'Category added successfully.');
    }
    
    public function edit_events(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'date_register_start' => 'required|date',
            'date_register_end' => 'required|date',
            'date_evaluate_start' => 'required|date',
            'date_evaluate_end' => 'required|date',
            'date_submission' => 'required|date',
            'date_announcement' => 'required|date',
            'date_ceremony' => 'required|date'
        ]);

        $event = Event::find($request->id);
        if ($event) {
            $event->name = $request->name;
            $event->description = $request->description;
            $event->date_register_start = $request->date_register_start;
            $event->date_register_end = $request->date_register_end;
            $event->date_evaluate_start = $request->date_evaluate_start;
            $event->date_evaluate_end = $request->date_evaluate_end;
            $event->date_submission = $request->date_submission;
            $event->date_announcement = $request->date_announcement;
            $event->date_ceremony = $request->date_ceremony;
            $event->save();
        } else {
            return redirect()->back()->with('error', 'Event not found.');
        }
        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    public function delete_events($id){
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return redirect()->back()->with('success', 'Event deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Event not found.');
        }
    }

    public function add_events(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'date_register_end' => 'required|date',
            'date_evaluate_start' => 'required|date',
            'date_evaluate_end' => 'required|date',
            'date_submission' => 'required|date',
            'date_announcement' => 'required|date',
            'date_ceremony' => 'required|date'
        ]);

        DB::table('events')->insert([
            'name' => $request['name'],
            'description' => $request['description'],
            'date_register_start' => $request['date_register_start'],
            'date_register_end' => $request['date_register_end'],
            'date_evaluate_start' => $request['date_evaluate_start'],
            'date_evaluate_end' => $request['date_evaluate_end'],
            'date_submission' => $request['date_submission'],
            'date_announcement' => $request['date_announcement'],
            'date_ceremony' => $request['date_ceremony']
        ]);

        return redirect()->back()->with('success', 'Event added successfully.');
    }

    public function update_awardStatus(Request $request){
        Excel::import(new AdminImport, $request->file('file'));

        return back()->with('success', 'Excel file imported successfully!');
    }
}
