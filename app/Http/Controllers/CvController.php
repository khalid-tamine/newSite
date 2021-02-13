<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Cv;
use App\Models\Projet;
use App\Models\Experience;
use Auth;
use App\Http\Requests\cvRequest;

class CvController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //afficher tout
    public function index(){
        if(Auth::user()->is_admin){
            $listCv = Cv::all();

        }else{
            $listCv = Cv::where('user_id', Auth::user()->id)->get();
        }

        return view('cv.index',['cvs' => $listCv]);
    }

    //form d'ajout
    public function create(){
        return view('cv.create');
    }
    //enregistrer
    public function store(cvRequest $request){

        $cv = new Cv();
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->user_id = Auth::user()->id;
        if($request->hasfile('photo')){
            $path = $request->photo->store('public/image');
            $cv->photo = substr($path,6);
        }

        $cv->save();

        session()->flash('success','le cv a été bien eneregitré');
        return redirect('cvs');
    }
    //form data
    public function edit($id){
        $cv = Cv::find($id);
        $this -> authorize('update', $cv);
        return view('cv.edit',['cv' => $cv]);
    }
    //modifier
    public function update(cvRequest $request , $id){
        $cv = Cv::find($id);

        $this -> authorize('update', $cv);

        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        if($request->hasfile('photo')){
            $path = $request->photo->store('public/image');
            $cv->photo = substr($path,6);
        }
        $cv->save();
        return redirect('cvs');
    }
    //supprimer
    public function destroy(Request $request , $id){
        $cv = Cv::find($id);

        $this -> authorize('delete', $cv);

        $cv->delete();
        return redirect('cvs');
    }

    public function show($id){
        return view('cv.show',['id' => $id]);
    }


    public function getData($id){
        $cv = Cv::find($id);
        $experiences = $cv->experiences()->orderBy('date_debut','desc')->get();
        $projets = $cv->projets()->orderBy('updated_at','desc')->get();

        return Response()->json([
                                    'experiences'=>$experiences,
                                    'projets'=>$projets
        ]);

    }

    //method d' experience
    public function addExperience(Request $request){
        $experience = new Experience;
        $experience->titre = $request->titre;
        $experience->body = $request->body;
        $experience->date_debut = $request->date_debut;
        $experience->date_fin = $request->date_fin;
        $experience->cv_id = $request->cv_id;

        $experience->save();

        return Response()->json(['etat' => true ,'id' => $experience->id]);
    }

    public function updateExperience(Request $request){
        $experience = Experience::find($request->id);
        $experience->titre = $request->titre;
        $experience->body = $request->body;
        $experience->date_debut = $request->date_debut;
        $experience->date_fin = $request->date_fin;
        $experience->cv_id = $request->cv_id;

        $experience->save();

        return Response()->json(['etat' => true]);
    }

    public function deleteExperience($id){
        $experience= Experience::find($id);
        $experience->delete();
        return Response()->json(['etat' => true]);
    }

    //method de projet
    public function addProjet(Request $request){
        $projet = new Projet;
        $projet->titre = $request->titre;
        $projet->description = $request->description;
        $projet->lien = $request->lien;
        $projet->image = $request->image;
        $projet->cv_id = $request->cv_id;

        $projet->save();

        return Response()->json(['etat' => true ,'id' => $projet->id]);
    }

    public function updateProjet(Request $request){
        $projet = Projet::find($request->id);
        $projet->titre = $request->titre;
        $projet->description = $request->description;
        $projet->lien = $request->lien;
        $projet->image = $request->image;
        $projet->cv_id = $request->cv_id;

        $projet->save();

        return Response()->json(['etat' => true]);
    }

    public function deleteProjet($id){
        $projet= Projet::find($id);
        $projet->delete();
        return Response()->json(['etat' => true]);
    }
}
