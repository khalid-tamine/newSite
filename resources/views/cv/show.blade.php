@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row">
    <h3>@{{ message }}</h3>
        <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-healing">


                 <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Experience</h3></div>
                     <div class="col-md-2 text-right">
                     <button class="btn btn-success"  @click="open.experience = true">Ajouter</button>
                     </div>
                 </div>

                <div class="panel-body">
                <div v-if="open.experience">
                <div>
                    <div class="form-group">
                        <label for="">Titre</label>
                        <input type="text" placeholder="titre" class="form-control" v-model="experience.titre">
                    </div>

                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea type="text" placeholder="body" class="form-control" v-model="experience.body"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Date debut</label>
                            <input type="date" placeholder="debut" class="form-control" v-model="experience.date_debut">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Date fin</label>
                            <input type="date" placeholder="fin" class="form-control" v-model="experience.date_fin">
                        </div>
                    </div>

                    <button v-if="edit.experience" class="btn btn-danger btn-block" @click="updateExperience" type="submit">Modifier</button>

                    <button v-else class="btn btn-info btn-block" @click="addExperience" type="submit">Ajouter</button>
                </div>



                </div>
                    <ul class="list-group">
                        <li class="list-group-item"  v-for="e in experiences">
                            <div class="text-right">
                                <button class="btn btn-warning btn-sm" @click ="editExperience(e)">Editer</button>

                                <button class="btn btn-danger btn-sm" @click ="deleteExperience(e)">Supprimer</button>
                            </div>
                            <h3>@{{e.titre}}</h3>
                            <p>@{{ e.body }}</p>
                            <small>@{{ e.date_debut}} - @{{ e.date_fin}}</small>
                        </li>

                    </ul>
                 </div>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-healing">


                 <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Projet</h3></div>
                     <div class="col-md-2 text-right">
                     <button class="btn btn-success"  @click="open.projet = true">Ajouter</button>
                     </div>
                 </div>

                <div class="panel-body">
                <div v-if="open.projet">
                <div>
                    <div class="form-group">
                        <label for="">Titre</label>
                        <input type="text" placeholder="titre" class="form-control" v-model="projet.titre">
                    </div>

                    <div class="form-group">
                        <label for="">description</label>
                        <textarea type="text" placeholder="description" class="form-control" v-model="projet.description"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">lien</label>
                            <input type="url" placeholder="lien vers projet" class="form-control" v-model="projet.lien">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">image</label>
                            <input type="url" placeholder="lien vers image" class="form-control" v-model="projet.image">
                        </div>
                    </div>

                    <button v-if="edit.projet" class="btn btn-danger btn-block" @click="updateProjet" type="submit">Modifier</button>

                    <button v-else class="btn btn-info btn-block" @click="addProjet" type="submit">Ajouter</button>
                </div>
                </div>
                <ul class="list-group">
                        <li class="list-group-item"  v-for="projet in projets">
                            <div class="text-right">
                                <button class="btn btn-warning btn-sm" @click ="editProjet(projet)">Editer</button>

                                <button class="btn btn-danger btn-sm" @click ="deleteProjet(projet)">Supprimer</button>
                            </div>
                            <h3>@{{projet.titre}}</h3>
                            <p>@{{ projet.description }}</p>
                            <small><a :href="projet.lien">Voir..</a></small>
                        </li>

                    </ul>



                 </div>
            </div>
        </div>


        </div>
    </div>
</div>

@section('javascripts')

<script src="../../js/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>




<script>
    window.Laravel = {!! json_encode([
        'csrfToken'=>csrf_token(),
        'idExperience'=>$id,
        'url'=>url('/')
    ])
    !!}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js"></script>

<script src="{{ asset('js/script.js') }}">

</script>


@endsection
@endsection
