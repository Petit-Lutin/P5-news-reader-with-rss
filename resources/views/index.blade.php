@extends('layouts/app')
@section('content')
    <div class="container containerIndex">
        <div class="card">
            <header class="card-header">
                <div class="row">
                    <div class="col text-center">
                        <a class="btn btn-primary text-center" href="/flows/create">Ajouter un site</a>
                    </div>
                    <div class="col"><h3 class="card-header-title">Mes abonnements RSS</h3>
                    </div>
                </div>
            </header>
            <div class="card-content">
                <div id="content">


                    <div class="indexContent">
                        <div id="flowsList">


                            <ul>
                                <li v-for="category in categories"><h4>@{{category.name}}
                                        <a href="#" @click="currentList=category.allNews"
                                           class="btn btn-primary btn-sm"
                                           role="button">Voir</a>
                                        <a
                                            v-bind:href="'/categories/edit/'+category.id"
                                            class="btn btn-primary btn-sm"
                                            role="button">Modifier</a>
                                        <a href="#" @click="show=true"
                                           class="btn btn-danger btn-sm" role="button"
                                           v-on:click="warnBeforeDelete('Voulez-vous supprimer cette catégorie ?', 'Tous les sites de cette catégorie - et tous les articles de ces sites - seront également supprimés et disparaîtront de votre fil de lecture.', '/categories/delete/'+category.id)">
                                            Supprimer</a>

                                    </h4>


                                    <ul>
                                        <li v-for="flow in category.flows">
                                            @{{flow.name}} <a href="#" @click="currentList=flow.news"><span
                                                    class="badge badge-success">Voir</span></a>
                                            <a v-bind:href="'/flows/edit/'+flow.id"><span
                                                    class="badge badge-primary">Modifier</span></a>
                                            <a href="#" @click="show=true"
                                               v-on:click="warnBeforeDelete('Voulez-vous supprimer ce site ?', 'Tous les articles de ce site disparaîtront de votre fil de lecture.', '/flows/delete/'+flow.id)"><span
                                                    class="badge badge-danger">Supprimer</span></a>

                                        </li>
                                    </ul>
                                    <hr>
                                </li>
                            </ul>
                        </div>

                        <div id="flowsContent">
                            <h5>Tout récemment</h5>
                            <ul>
                                <li v-for="anew in latest">

                                    <h5>
                                        <a v-bind:href="anew.article_link">@{{anew.article_title}}</a>, le
                                        @{{ anew.article_date }}
                                    </h5>

{{--todo:trier les news selon le flux/catégories dans latest--}}
                                </li>
                            </ul>
                            <div v-show="!loaded" class="loader">
                                <div class="loadingCircle"></div>
                            </div>

                            <button v-if="error" class="btn btn-primary">@{{error}}</button>
                            <ul>
                                <li v-for="category in categories"> @{{ category.category_name}}
                                    <ul>
                                        <li v-for="flow in category.flows">

                                            <p v-show="empty">Les articles de vos flux s'afficheront ici, triés par
                                                date décroissante. Pour le moment, votre liste de lecture est vide.
                                                Ajoutez un site
                                                !</p>
                                            <ul>
                                                <li v-for="anew in currentList">
                                                    <a v-bind:href="anew.article_link">
                                                        @{{ anew.article_title }}</a>, @{{ anew.article_date }}
                                                </li>
                                            </ul>
                                            <ul>
                                                <li v-for="anew in flow.news"> @{{anew.article_title}} : <a
                                                        v-bind:href="anew.article_link">Lire
                                                        l'article sur le site</a>,
                                                    le @{{ anew.article_date }} <br>

                                                </li>
                                            </ul>

                                        </li>
                                    </ul>
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
                                    {{--                                    <a v-on:click.stop.prevent="doThat" class="btn btn-secondary" role="button"--}}
                                    {{--                                       data-dismiss="modal" @click="show=false">Annuler</a>--}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            @click="show=false">Annuler
                                    </button>
                                    {{--                                    <button type="button" class="btn btn-danger" @click="show=false">Supprimer</button>--}}
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
                                latest: [],
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
                                    // event.stopPropagation()
                                    // event.preventDefault()
                                    console.log(href);
                                    // if (event) {
                                    //
                                    // }
                                    // if (!confirm(message)){
                                    //     event.preventDefault()
                                    //
                                    // }
                                    // show: false
                                }
                            },
                            mounted() {
                                if (typeof categories === "undefined") {
                                    this.loaded = true;
                                }
                                let toLoad = 0; // au début de l'asynchrone

                                for (let c = 0; c < this.categories.length; c++) {
                                    let category = this.categories[c];
                                    this.categories[c].allNews = [];

                                    for (let f = 0; f < category.flows.length; f++) {
                                        let flow = category.flows[f];
                                        // console.log("---", flow.name)
                                        toLoad++; //compte les flux

                                        if (typeof flow === "undefined") {
                                            this.loaded = true;
                                        }

                                        axios.get('/getjson/' + flow.id) // Make a request for a user with a given ID, Axios en requête GET
                                            .then((response) => {
                                                // handle success

                                                flow.news = response.data;
                                                // console.log(response.data);

                                                for (const article of response.data) {
                                                    this.allNews.push(article);
                                                    this.categories[c].allNews.push(article);
                                                }

                                            })
                                            .catch(function (error) {
                                                // handle error
                                                // console.log("flow id", flow.id);
                                                console.log(error);

                                            })
                                            .finally(() => {
                                                // always executed

                                                toLoad--; //flux chargé


                                                if (toLoad == 0) { //quand tous les flux sont chargés, on peut trier les articles
                                                    // console.log("triez maintenant");
                                                    // console.log(this.allNews); //undefined, mais résolu avec fonction anonyme fléchée = on ne perd plus le this
                                                    // console.log(flow.news); // retourne bien les news, array
                                                    // array.sort sur allNews par date antichrono
                                                    // console.log(article); // retourne bien les news, obj
                                                    // console.log(flow.news.article_date); // retourne bien les dates des news


                                                    this.loaded = true; // toutes les news sont chargées, on cache le loader

                                                    this.empty = false;

                                                    this.allNews = this.allNews.sort((a, b) => new Date(b.article_timestamp) - new Date(a.article_timestamp));
                                                    this.latest = this.allNews.splice(0, 5); // les 5 dernières news affichées à part

                                                    for (i = 0; i < this.categories.length; i++) {
                                                        this.categories[i].allNews = this.categories[i].allNews.sort((a, b) => new Date(b.article_timestamp) - new Date(a.article_timestamp));
                                                    }

                                                    this.currentList = this.allNews;
                                                }

                                            });
                                    }
                                }
                            }
                        })
                    ;

                    // const mesBalises = document.querySelectorAll(".toConfirm");
                    //
                    // for (i = 0; i < mesBalises.length; i++) {
                    //     mesBalises[i].addEventListener("click", (e) => {
                    //         let message = e.currentTarget.getAttribute("data-message"); //affiche le message contenu dans l'attribut message du lien
                    //         if (!confirm(message)) {
                    //             e.preventDefault();
                    //             e.stopPropagation();
                    //         }
                    //     })
                    // }
                </script>
@endsection
@section('footer')
    @include('footer')
@endsection
