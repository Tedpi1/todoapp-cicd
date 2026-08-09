<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class TaskManager extends Controller
{
    function listTask(){
        $notes= Notes::all();
        return view('notes.home',compact('notes'));
    }
    function addTask(){
        return view('notes.home');
    }
    function addTaskPost(Request $request){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'date'=>'required'
        ]);
        $notes= new Notes();
        $notes->title= $request->title;
        $notes->content= $request->content;
        $notes->date= $request->date;
        if($notes->save()){
            return redirect(route('home'))->with('success','Task added successfully');
        }
        return redirect(route('add.task'))->with('error','Task not added');
    }

    function updateTask($id){
        if(Notes::where('id', $id)->update(['status'=> 'completed'])){
            return redirect(route('home'))->with('success','Notes Done successfully');
        }
        return redirect(route('home'))->with('error','Notes not Dpme');
    }
}
