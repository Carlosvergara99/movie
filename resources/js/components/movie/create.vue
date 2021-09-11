<template>
 <div class="modal fade bd-example-modal-lg" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5  class="modal-title" id="addNewLabel">Crear Pelicula </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <form  @submit.prevent="createMovie()" >
                     <div class="modal-body">
                      <div class="form-row">

                              <div class="form-group col-md-6">
                                 <label>Titulo</label>
                                 <input v-model="form.title" type="text" class="form-control" placeholder="Titulo" >
                             </div>
                              <div class="form-group col-md-3">
                                 <label>Duracion</label>
                                 <br>
                                   <vue-timepicker v-model="form.duration" format="HH:mm:ss" input-width="12em" auto-scroll></vue-timepicker>
 
                                 <!-- <input v-model="form.duration" type="times"  class="form-control" placeholder="Duracion" > -->
                             </div>

                             <div class="form-group col-md-3">
                                 <label>Fecha de estreno </label>
                                 <input  v-model="form.release_date" type="date" class="form-control"  >
                             </div>

                             
                              <div class="form-group col-md-6">
                                 <label>Categorías </label>
                                    <v-select v-model="form.category_id"  :options="category" :reduce="categories => categories.id" label="name" multiple ></v-select>
                             </div>

                            <div class="form-group col-md-6">
                                 <label>Trailer </label>
                                 <input v-model="form.trailer" type="text" class="form-control"  placeholder="Trailer de youtube">
                             </div>
                             <div class="form-group col-md-6">
                                 <label>Descripcion</label>
                                <textarea v-model="form.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                             </div>


                            <div class="form-group col-md-6 d-flex flex-column align-items-start">
                                <label>Imagen</label>

                                <img  :src="imagen" class="rounded float-left" alt="" width="125" height="120" >
                                <input type="file" @change="ObtenerImg"  accept="image/png, image/jpeg" >

                             </div>

                             

                             
                     </div>
              </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Create</button>
           </div>
        </form>
       </div>
    </div>
</div>
</template>
<script>
import VueTimepicker from 'vue2-timepicker'

export default {
   props: {
   category: Array
 },
      data (){
          
           return {
               
                form: {
                    title:'',
                    duration:{
                         HH: '',
                         mm: '',
                         ss: ''
                    },
                    release_date:'',
                    category_id:'',
                    trailer:'',
                    description:'',
                    cover:''
                },
                cover:'',
                // category:[]
 
           } 
      },
        components: { VueTimepicker },

      mounted(){
      },
      methods:{
             ObtenerImg(e){
                let file =e.target.files[0];
                this.form.cover =file
                this.cargarImg(file);
            },
            cargarImg(file){
               let cargar =new FileReader();
                cargar.onload =(e)=>{
                  this.cover =e.target.result;
                }
               cargar.readAsDataURL(file);
            },
            createMovie(){
              const urlParts = /^(?:\w+\:\/\/)?([^\/]+)([^\?]*)\??(.*)$/.exec(this.form.trailer);
                if (this.form.title == '') {
                 Swal.fire({
                   icon: 'error',title: 'el campo titulo es obligatorio'
                  })
                }else if(this.form.duration.HH =='' ){
                   Swal.fire({
                   icon: 'error',title: 'la hora de la pelicula es obligatorio'
                  })
                }else if(this.form.duration.mm =='' ){
                   Swal.fire({
                   icon: 'error',title: 'los minutos de la pelicula es obligatorio'
                  })
                }
                  else if(this.form.duration.ss =='' ){
                   Swal.fire({
                   icon: 'error',title: 'los segundos  de la pelicula es obligatorio'
                  })
                 } else if(this.form.release_date =='' ){
                   Swal.fire({
                   icon: 'error',title: 'la fecha de estreno  de la pelicula es obligatorio'
                  })
                   } else if(this.form.category_id == ''){
                   Swal.fire({
                   icon: 'error',title: 'la categotia  de la pelicula es obligatorio'
                  })
                   } else if(this.form.trailer =='' ){
                   Swal.fire({
                   icon: 'error',title: 'el trailer  de la pelicula es obligatorio'
                  })
                   } else if(urlParts[1] !=='www.youtube.com' ){
                   Swal.fire({
                   icon: 'error',title: 'el trailer de la pelicula debe ser de youtube'
                  })
                   } else if(urlParts[2] =='/' || urlParts[2] ==''){
                   Swal.fire({
                   icon: 'error',title: 'Url invalido '
                  })
                   } else if(this.form.description =='' ){
                   Swal.fire({
                   icon: 'error',title: 'la Descripcion  de la pelicula es obligatorio'
                  })
                  } else if(this.form.cover =='' ){
                   Swal.fire({
                   icon: 'error',title: 'la imagen de la pelicula es obligatorio'
                  })
                }else{
                  this.form.duration =this.form.duration.HH+':' +this.form.duration.mm+':'+ this.form.duration.ss
                    axios.post('api/movie/create',this.form).then((response) => {    
                      $('#addNew').modal('hide');
                          Swal.fire({
                             icon: 'success',title: 'la pelicula se ha registrado con exito'
                         })
                      this.form={
                          title:'',
                          duration:{
                            HH: '',
                            mm: '',
                            ss: ''
                          },
                          release_date:'',
                          category_id:'',
                          trailer:'',
                          description:'',
                          cover:''
                        }
                         this.$emit('GetMovies');

                      }).catch((errors) => {
                        Swal.fire({
                          icon: 'error',title: 'ha ocurrido un fallo en el servidor'
                         })
                      })
                 }
            }

         },
      computed:{
            imagen(){
              this.form.cover = this.cover
                return this.cover;
           }
    }

      
    }
    

</script>