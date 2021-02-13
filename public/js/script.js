var app = new Vue({
    el:'#app',
    data:{
        message:'je suis khalid',
        experiences: [],
        projets: [],
        experience: {
            id:0,
            cv_id: window.Laravel.idExperience,
            titre:'',
            body:'',
            date_debut:'',
            date_fin:''
        },
        projet: {
            id:0,
            cv_id: window.Laravel.idExperience,
            titre:'',
            description:'',
            lien:'',
            image:''
        },
        open: {
            experience: false,
            projet: false
        },
        edit: {
            experience: false,
            projet: false
        }
    },
    methods:{
        getData: function(){
            axios.get(window.Laravel.url+'/getdata/'+window.Laravel.idExperience)
            .then(response => {
                this.experiences = response.data.experiences;
                this.projets = response.data.projets;
                console.log('response', response.data);
            })
            .catch(error => {
                console.log('error', error);
            })
        },
        addExperience:function(){
            axios.post(window.Laravel.url+'/addexperience',this.experience)
            .then(response => {
               if(response.data.etat){
                    this.open.experience = false;
                    this.experience.id= response.data.id;
                    this.experiences.unshift(this.experience);
                    this.experience ={
                        id:0,
                        cv_id: window.Laravel.idExperience,
                        titre:'',
                        body:'',
                        date_debut:'',
                        date_fin:''
                    };
               }
            })
            .catch(error => {
                console.log('error', error);
            })
        },
        editExperience:function(e){
            this.open.experience=true;
            this.edit.experience=true;
            this.experience=e;
        },
        updateExperience:function(){
            axios.put(window.Laravel.url+'/updateexperience',this.experience)
            .then(response => {
               if(response.data.etat){
                    this.open.experience = false;
                    this.experience ={
                        id:0,
                        cv_id: window.Laravel.idExperience,
                        titre:'',
                        body:'',
                        date_debut:'',
                        date_fin:''
                    };
               }
               this.edit.experience=false;
            })
            .catch(error => {
                console.log('error', error);
            })
        },
        deleteExperience:function(e){

            Swal.fire({
                title: 'Etes vous sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui , supprimer!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(window.Laravel.url+'/deleteexperience/'+e.id)
                    .then(response => {
                    if(response.data.etat){
                        var position = this.experiences.indexOf(e);
                        this.experiences.splice(position, 1);
                    }

                    })
                    .catch(error => {
                        console.log('error', error);
                    })
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })


        },
        //Module de gestion de projet
        addProjet:function(){
            axios.post(window.Laravel.url+'/addprojet',this.projet)
            .then(response => {
               if(response.data.etat){
                    this.open.projet = false;
                    this.projet.id= response.data.id;
                    this.projets.unshift(this.projet);
                    this.projet ={
                        id:0,
                        cv_id: window.Laravel.idExperience,
                        titre:'',
                        description:'',
                        lien:'',
                        image:''
                    };
               }
            })
            .catch(error => {
                console.log('error', error);
            })
        },
        editProjet:function(projet){
            this.open.projet=true;
            this.edit.projet=true;
            this.projet=projet;
        },
        updateProjet:function(){
            axios.put(window.Laravel.url+'/updateprojet',this.projet)
            .then(response => {
               if(response.data.etat){
                    this.open.projet = false;
                    this.projet ={
                        id:0,
                        cv_id: window.Laravel.idExperience,
                        titre:'',
                        description:'',
                        lien:'',
                        image:''
                    };
               }
               this.edit.projet=false;
            })
            .catch(error => {
                console.log('error', error);
            })
        },
        deleteProjet:function(projet){

            Swal.fire({
                title: 'Etes vous sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui , supprimer!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(window.Laravel.url+'/deleteprojet/'+projet.id)
                    .then(response => {
                    if(response.data.etat){
                        var position = this.projets.indexOf(projet);
                        this.projets.splice(position, 1);
                    }

                    })
                    .catch(error => {
                        console.log('error', error);
                    })
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })


        }
    },
    mounted:function(){
        this.getData();
    }
});
