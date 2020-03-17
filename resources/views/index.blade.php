@extends('layouts/app')
@section('content')
    <div class="container containerIndex">
        <div class="card">
            <header class="card-header">
                <div class="row">
                    <div class="col ">
                        <a class="btn btn-success" href="/index">Rafraîchir <i
                                class="fas fa-sync-alt"></i></a>
                        <a class="btn btn-primary text-center" href="/flows/create">Ajouter un site</a>
                    </div>
                    <div class="col"><h3 class="card-header-title">Mes
                            abonnements RSS</h3>
                    </div>
                </div>
            </header>

            <div class="card-content">
                <div id="content">

                    <div class="indexContent">
                        {{--                        panneau latéral avec affichage des catégories et des flux--}}
                        <div id="flowsList">
                            <ul id="listCategories">
                                <li v-for="category in categories"><h4><a href="#"
                                                                          @click="currentList=category.allNews">
                                            <i class="fas fa-book-open"></i> @{{category.name}}</a>
                                        <small>
                                            <a
                                                v-bind:href="'/categories/edit/'+category.id"
                                                role="button"><span
                                                    class="badge badge-primary bouton">Modifier <i
                                                        class="fas fa-pencil-alt"></i></span></a>
                                            <a href="#" @click="show=true" role="button"
                                               v-on:click="warnBeforeDelete('Voulez-vous supprimer cette catégorie ?', 'Tous les sites de cette catégorie - et tous les articles de ces sites - seront également supprimés et disparaîtront de votre fil de lecture.', '/categories/delete/'+category.id)">
                                                <span class="badge badge-danger bouton">Supprimer <i
                                                        class="fas fa-trash-alt"></i></span></a>
                                        </small></h4>

                                    <ul id="listFlux">
                                        <li v-for="flow in category.flows_order_by"><a href="#"
                                                                                       @click="currentList=flow.news"><i
                                                    class="fas fa-bookmark"></i> @{{flow.name}}</a>

                                            <a v-bind:href="'/flows/edit/'+flow.id"><span
                                                    class="badge badge-primary"><i class="fas fa-pencil-alt"></i></span></a>
                                            <a href="#" @click="show=true"
                                               v-on:click="warnBeforeDelete('Voulez-vous supprimer ce site ?', 'Tous les articles de ce site disparaîtront de votre fil de lecture.', '/flows/delete/'+flow.id)">
                                                <span class="badge badge-danger"><i
                                                        class="fas fa-trash-alt"></i></span></a>

                                        </li>
                                    </ul>
                                    <hr>
                                </li>
                            </ul>
                        </div>

                        <div id="flowsContent">
                            <div v-show="!loaded" class="loader">
                                <div class="loadingCircle"></div>
                            </div>
                            <p v-show="empty">Les articles de vos flux s'afficheront ici, triés par
                                date décroissante. Pour le moment, votre liste de lecture est vide.
                                Ajoutez un site
                                !</p>


                            <ul>
                                <li v-for="anew in currentList">
                                    @{{ anew.channel_title }} :
                                    <a v-bind:href="anew.article_link">@{{ anew.article_title }}</a>, <span
                                        class="text-muted date"> @{{
                                    anew.article_date }}</span>
                                </li>
                            </ul>


                        </div>
                    </div>
                    <div v-show="show" v-bind:class="{'show':show}" class="modal fade" id="exampleModal" tabindex="-1"
                         role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@{{ modalTitle }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                            @click="show=false">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @{{ modalContent }}
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            @click="show=false">Annuler
                                    </button>
                                    <a v-bind:href="href" type="button" class="btn btn-danger" role="button"
                                       @click="show=false">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            @endsection

            @section('scripts')
                {{--                ajout AXIOS pour faire de l'AJAX--}}
                <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                <script>
                    //script vue js
                    var vue = new Vue({
                            el: "#content",
                            data: {
                                categories:{!!$jsonCategories!!},
                                currentList: [], // obj littéral qui contient un tableau flows qui contient un tableau news
                                allNews: [],
                                // latest: [],
                                error: false,
                                show: false,
                                loaded: false,
                                empty: true,
                                modalTitle: '',
                                modalContent: '',
                                href: '',
                            },
                            methods: {
                                warnBeforeDelete: function (message, content, href) {
                                    this.modalTitle = message;
                                    this.modalContent = content;
                                    this.href = href;
                                    console.log(href);
                                }
                            },
                            mounted() {

                                let toLoad = 0; // au début de l'asynchrone
                                if (this.categories.length === 0) {
                                    this.loaded = true;
                                    flow = null;
                                    toLoad = 0;
                                }
                                for (let c = 0; c < this.categories.length; c++) {
                                    let category = this.categories[c];

                                    this.categories[c].allNews = [];

                                    for (let f = 0; f < category.flows_order_by.length; f++) {
                                        let flow = category.flows_order_by[f];
                                        toLoad++; //compte les flux

                                        if (typeof flow === "undefined") { //si pas de flux à afficher ou à charger, on cache le loader
                                            this.loaded = true;
                                            toLoad = 0;
                                        }

                                        axios.get('/getjson/' + flow.id) // Make a request for a user with a given ID, Axios en requête GET
                                            .then((response) => {
                                                // handle success
                                                flow.news = response.data;

                                                for (const article of response.data) {
                                                    this.allNews.push(article);
                                                    this.categories[c].allNews.push(article);
                                                }

                                            })
                                            .catch(function (error) {
                                                // handle error
                                                console.log(error);

                                            })
                                            .finally(() => {
                                                // always executed
                                                toLoad--; //flux chargé

                                                if (toLoad == 0) { //quand tous les flux sont chargés, on peut trier les articles


                                                    this.loaded = true; // toutes les news sont chargées, on cache le loader

                                                    this.empty = false;

                                                    this.allNews = this.allNews.sort((a, b) => new Date(b.article_timestamp) - new Date(a.article_timestamp));

                                                    for (i = 0; i < this.categories.length; i++) {
                                                        this.categories[i].allNews = this.categories[i].allNews.sort((a, b) => new Date(b.article_timestamp) - new Date(a.article_timestamp));
                                                    }
                                                    // this.latest = this.allNews.splice(0, 5); // les 5 dernières news affichées à part
                                                    // this.allNews= this.allNews.splice(this.allNews.length, 5); // les 5 dernières news affichées à part

                                                    this.currentList = this.allNews;
                                                }
                                            });
                                    }
                                }
                            }
                        })
                    ;

                </script>
@endsection
@section('footer')
    @include('footer')
@endsection
