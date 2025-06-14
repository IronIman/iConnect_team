<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Project;

class ProjectController extends Controller
{
    public function add(Request $request){
        $customID = $this->generateCustomID();

        $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'leader' => 'required',
            'organisation' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'member1' => 'required', 
            'technical_paper' => 'nullable|file'
        ]);

        if(!empty($request->technical_paper)){
            $path = $request->file('technical_paper')->store('storage','public');
        }
        else{
            $path = null;
        }

        DB::table('projects')->insert([
            'id' => $customID,
            'title' => $request['title'],
            'abstract' => $request['abstract'],
            'leader' => $request['leader'],
            'organisation' => $request['organisation'],
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'member1' => $request['member1'],
            'member2' => $request['member2'],
            'member3' => $request['member3'],
            'member4' => $request['member4'],
            'link' => $request['link'],
            'receipt' => 'NOT PAID',
            'publication' => $request['publication'],
            'technical_paper' => $path,
            'category_id' => $request['category_id'],
            'user_id' => $request['user_id'],
            'event_id' => $request['event_id']
        ]);
        return redirect('dashboard');
    }

    public function edit(Request $request){
        $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'leader' => 'required',
            'organisation' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'member1' => 'required', 
            'publication' => 'string',
            'technical_paper' => 'nullable|file'
        ]);

        if(!empty($request->technical_paper)){
            $path = $request->file('technical_paper')->store('storage','public');
        }
        else{
            $path = DB::table('projects')->select('technical_paper')->where('id','=',$request->id);
        }

        DB::table('projects')
        ->where('id','=',$request->id)
        ->update(
            ['title' => $request['title'],
                    'abstract' => $request['abstract'],
                    'leader' => $request['leader'],
                    'organisation' => $request['organisation'],
                    'address' => $request['address'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    'member1' => $request['member1'],
                    'member2' => $request['member2'],
                    'member3' => $request['member3'],
                    'member4' => $request['member4'],
                    'link' => $request['link'],
                    'publication' => $request['publication'],
                    'technical_paper' => $path,
                    'category_id' => $request['category_id'],
                    'event_id' => $request['event_id']
                ]
            );
        $this->updateStatus($request->id);
        return redirect('dashboard');
    }

    public function delete(Request $request){
        $project = Project::find($request->id);
        if ($project) {
            $project->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }
    
    public function downloadFILE(Request $request){
        $projects = DB::table('projects')
        ->select('*')
        ->where('id','=',$request->id)
        ->first();
        if($request->type == 'LOA'){
            $pdf = PDF::loadView('pdf_template\pdf_loa', compact('projects'))->setPaper('a4','portrait');
            return $pdf->stream('loa.pdf');   
        }
        elseif($request->type == 'RECEIPT'){
            $pdf = PDF::loadView('pdf_template\pdf_receipt', compact('projects'))->setPaper('a4','portrait');
            return $pdf->stream('receipt.pdf');
        }
        elseif($request->type == 'PARTICIPATION'){
            $pdf = PDF::loadView('pdf_template\pdf_participation', compact('projects'))->setPaper('a4','portrait');
            return $pdf->stream('participation.pdf');
        }
        elseif($request->type == 'AWARD'){
            $pdf = PDF::loadView('pdf_template\pdf_award', compact('projects'))->setPaper('a4','portrait');
            return $pdf->stream('award.pdf');
        }
    }

    private function generateCustomID($prefix = 'IDR', $length = 6) {
        // Get the last custom_id (e.g., 'IDR-000123')
        $last = DB::table('projects')
            ->where('id', 'LIKE', $prefix . '-%')
            ->orderByDesc('id')
            ->value('id');

        if ($last) {
            // Extract the numeric part and increment
            $number = (int) str_replace($prefix . '-', '', $last);
            $next = $number + 1;
        } else {
            $next = 1;
        }

        // Pad the number with leading zeroes
        $padded = str_pad($next, $length, '0', STR_PAD_LEFT);

        return "{$prefix}-{$padded}";
    }

    private function updateStatus($id){
        $project = Project::where('id', "=",$id)->first();
        if ($project->receipt != "NOT PAID" && !empty($project->link)) {
            $project->update([
                'status' => 'SUBMITTED'
            ]);

            return back()->with("success","Status changed to SUBMITTED!");
        }

        return back()->with('error', 'Status still DRAFT!');
    }

}
