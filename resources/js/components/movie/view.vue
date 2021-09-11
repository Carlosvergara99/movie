<template> 
<div class="container"> 
  <Menu :category="category"  />
  <div class="p-1 d-flex flex-column align-items-end"> <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">+</button>
  </div>
  <Create :category="category"  @GetMovies="getmovies"/>
     
    <div class="card-columns">
      <div v-for="movie in movies" :key="movies.id" class="card">
        <img class="card-img-top" v-bind:src="movie.cover"  style="height:250px">
        <div class="card-body">
          <h5 class="card-title"> <b>{{movie.title}}</b>           
          <div class="d-flex bd-highlight ">
             <small class="p-2 flex-grow-1 bd-highlight">
                <i class="far fa-clock"></i> 
                {{movie.duration}}
             </small>
              <small class="p-2 bd-highlight">
                 <i class="fas fa-calendar-day"></i>
                 {{moment(movie.release_date) }}
              </small>
          </div>
          </h5>
          <p class="card-text">
              <span  class="badge badge-primary" v-for="category in movie.movies_categories" >
              {{category.categories[0].name}}
              </span>
              
          </p>
          <p class="card-text">Descripcion:
            {{movie.description}}
          </p>
      </div>
      </div>
    </div>
  </div>

</template>

<script>
import Menu from '../menu.vue'
import Create from '../movie/create.vue'
import moment from 'moment'

    export default {
    components: {
          Menu,
          Create
      },
       data (){
           return {
             movies:{},
             category:[]

           }
       },
      mounted(){
        this.GetMovies()
        this.GetCategories()
      },
      methods:{
           moment(date) {
            return moment(date).format('L')
           },
           openModalWindow(){
             $('#addNew').modal('show');
           },
           GetMovies(){
             axios.get('api/movie/get').then((response) => {
                    this.movies =response.data
                    }).catch((errors) => {
              })
           },
           getmovies(){
              this.GetMovies()
           },
           GetCategories(){
                axios.get('api/categories/get').then((response) => {
                    this.category =response.data
                    }).catch((errors) => {
                 })
            }
      }

      
    }
    

</script>
<style >
 h1 {
  color: #fff;
  padding: 10px 0;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  transition: 0.3s;
  border: none;
  &:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
  }
  a {
    color: initial;
    &:hover {
      text-decoration: initial;
    }
  }
  .text-muted i {
    margin: 0 10px;
  }
}
</style>