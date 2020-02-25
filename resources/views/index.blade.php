@extends('layouts/app')
@section('content')

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Mes abonnements RSS</p>
        </header>
        <div class="card-content">
            <div id="content">
                <a class="btn btn-primary" href="/flows/create">Ajouter un site</a>
                <div class="indexContent">
                    <div class="flowsList">
                        {{--                        @foreach($categories as $category)--}}
                        <ul>
                            <li v-for="category in categories"><h2>@{{category.name}} <small>
                                        <a href="#" @click="currentList=category.allNews">Voir</a>
                                        <a
                                            v-bind:href="'/categories/edit/'+category.id">Modifier</a></small> <small><a
                                            v-bind:href="'/category/delete/'+category.id" class="toConfirm"
                                            data-message="Voulez-vous vraiment supprimer cette catégorie ? Les flux à l'intérieur seront également supprimés de la base de données.">Supprimer</a>
                                    </small>
                                </h2>


                                <ul>
                                    {{--                                        @foreach($category->flowsOrderBy as $flow)--}}
                                    <li v-for="flow in category.flows">
                                        @{{flow.name}} <a href="#" @click="currentList=flow.news">Voir</a>
                                        <small><a v-bind:href="'/flows/edit/'+flow.id">Modifier</a></small>
                                        <small><a v-bind:href="'/flows/delete/'+flow.id" class="toConfirm"
                                                  data-message="Voulez-vous vraiment retirer ce site ?">Supprimer</a>
                                        </small>
                                    </li>
                                    {{--                                        @endforeach--}}
                                </ul>
                            </li>
                        </ul>
                        {{--                        @endforeach--}}
                    </div>

                    <div id="flowsContent">Les flux doivent s'afficher ci-dessous, les news doivent être par triées par
                        date décroissante.
                        <ul>
                            <li v-for="anew in currentList">
                                <a v-bind:href="anew.article_link">
                                    @{{ anew.article_title }}
                                </a>, le @{{ anew.article_date }}
                            </li>
                        </ul>


                        <button v-if="error" class="btn btn-primary">@{{error}}</button>
                        {{--                        <ul>--}}
                        {{--                            <li v-for="category in categories"> @{{ category.category_name}}--}}
                        {{--                                <ul>--}}
                        {{--                                    <li v-for="flow in category.flows">--}}
                        {{--                                                                                <ul>--}}
                        {{--                                                                                    <li v-for="anew in latest">--}}

                        {{--                                                                                        <h5>--}}
                        {{--                                                                                            <a v-bind:href="anew.article_link">@{{anew.article_title}}</a>, le--}}
                        {{--                                                                                            @}}--}}
                        {{--                                                                                            anew.article_date }}</h5>--}}
                        {{--                                                                                                                        <p>@{{ anew.article_description }}</p>--}}

                        {{--                                                                                    </li>--}}
                        {{--                                                                                </ul>--}}
                        <p> Archives</p>

                        {{--                                        <ul>--}}
                        {{--                                            <li v-for="anew in flow.news"> @{{anew.article_title}} : <a--}}
                        {{--                                                    v-bind:href="anew.article_link">Lire--}}
                        {{--                                                    l'article sur le site</a>,--}}
                        {{--                                                le @{{ anew.article_date }} <br>--}}
                        {{--                                                <div v-html="anew.article_description"></div>--}}
                        {{--                                                <p>@{!! anew.article_description !!}</p>--}}
                        {{--                                            </li>--}}
                        {{--                                        </ul>--}}

                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </li>--}}


                        {{--                        </ul>--}}
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{'show':show}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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
                                // news: [
                                //     {
                                //         // channel_title: "nom du flux",
                                //         article_title: "title1",
                                //         article_link: "link1",
                                //         article_date: "date",
                                //         article_description: "article_desc1"
                                //     },
                                //     {
                                //         article_title: "title2",
                                //         article_link: "link2",
                                //         article_date: "date",
                                //         article_description: "article_desc2"
                                //     },
                                //     {
                                //         article_title: "title3",
                                //         article_link: "link3",
                                //         article_date: "date",
                                //         article_description: "article_desc3"
                                //     }
                                // ],

                                // latest:
                                //     [],

                                // categories: [{
                                //     category_name: 'category name',
                                //     flows: [
                                //         {
                                //             channel_title: 'flow name1',
                                //             news: [
                                //                 {
                                //                     article_title: "title1",
                                //                     article_link: "link1",
                                //                     article_date: "date"
                                //                 }
                                //             ]
                                //         },
                                //         {
                                //             channel_title: 'flow name2',
                                //             news: [
                                //                 {
                                //                     article_title: "title1",
                                //                     article_link: "link1",
                                //                     article_date: "date"
                                //                 }
                                //             ]
                                //         }
                                //     ]
                                // }],
                                currentList: [], // obj littéral qui contient un tableau flows qui contient un tableau news
                                categories:{!!$jsonCategories!!},
                                allNews: [],
// , channel_title:"nomduflux", {article_title:"titre"}, //liste catégories contient liste flux contient liste articles, avec latest ? v-for dans un v-for dans un v-for
                                error: false,
                                show: false,
                                loaded: false,
                            },
                            mounted() {

                                let toLoad = 0; // au début de l'asynchrone

                                for (let c = 0; c < this.categories.length; c++) {
                                    let category = this.categories[c];
                                    this.categories[c].allNews = [];
                                    // console.log(category);
                                    // console.log(category.name);

                                    for (let f = 0; f < category.flows.length; f++) {
                                        let flow = category.flows[f];
                                        // console.log("---", flow.name)
                                        toLoad++; //compte les flux

                                        axios.get('/getjson/' + flow.id) // Make a request for a user with a given ID, Axios en requête GET
                                            .then((response) => {
                                                // handle success
                                                flow.news = response.data;
                                                // console.log(response.data);

                                                for (const article of response.data) {
                                                    this.allNews.push(article);
                                                    this.categories[c].allNews.push(article);
                                                    // this.pubDate = article.article_date;

                                                    // console.log(typeof this.pubDate); //string
                                                    // console.log(this.pubDate)  // renvoie la date de publication de l'article
                                                }

                                                // this.latest = this.allNews.splice(0, 5); // les 5 dernières news affichées à part
                                            })
                                            .catch(function (error) {
                                                // handle error
                                                console.log("flow id", flow.id);
                                                console.log(error);

                                            })
                                            .finally(() => {
                                                // always executed

                                                toLoad--; //flux chargé
                                                if (toLoad == 0) { //quand tous les flux sont chargés, on peut trier les articles
                                                    console.log("triez maintenant");
                                                    // console.log(this.allNews); //undefined, mais résolu avec fonction anonyme fléchée = on ne perd plus le this
                                                    // console.log(flow.news); // retourne bien les news, array
                                                    // array.sort sur allNews par date antichrono
                                                    // console.log(article); // retourne bien les news, obj
                                                    // console.log(article.article_date); // retourne bien les dates des news
                                                    //todo: faire un loader qui indique que la page a fini de charger, div en pos absolute, top O left 0 width 100% height 100% avec zindex important, avec bootstrap attribuer class d-none
                                                    //this.loaded=true, faire un v-bind avec condition

                                                    this.allNews = this.allNews.sort((a, b) => new Date(b.article_date) - new Date(a.article_date));

                                                    for (i = 0; i < this.allNews.length; i++) {
                                                        console.log(this.allNews[i].article_date);
                                                    }
                                                    for (i = 0; i < this.categories.length; i++) {
                                                        this.categories[i].allNews = this.categories[i].allNews.sort((a, b) => new Date(b.article_date) - new Date(a.article_date));
                                                    }

                                                    this.currentList = this.allNews;

                                                    // this.currentList = {flows: [{news: this.allNews}]}; //forme d'une catégorie
                                                    // this.currentList = {flows: [{news: flow.news}]}; //forme d'une catégorie


                                                    //
                                                    //
                                                    //     for (i = 0; i < article.length; i++) {
                                                    //         let pubDates = article.article_date;
                                                    //         let pubDate = pubDates[i];
                                                    //         // let a = pubDate[i];
                                                    //         // let b = pubDate[i + 1];
                                                    //         // console.log(a);
                                                    //         this.allSortedNews = [];
                                                    //         // flow.news.sort(function (pubDate, pubDates[i + 1])
                                                    //         // {
                                                    //         //     return new Date(pubDate.date) - new Date(pubDates[i + 1].date);
                                                    //         // }
                                                    //     // )
                                                    //     //     ;
                                                    //         this.allSortedNews.push(articles);
                                                    //     }


                                                    // array.sort(function(a,b){
                                                    //     // Turn your strings into dates, and then subtract them
                                                    //     // to get a value that is either negative, positive, or zero.
                                                    //     return new Date(b.date) - new Date(a.date);
                                                    // });


                                                    // let allNews = [];

                                                    // console.log(pubDate);
                                                }

                                            });
                                    }

                                }
                            }
                        })
                    ;

                    const mesBalises = document.querySelectorAll(".toConfirm");
                    // todo : une modal -> suppresion catégorie
                    for (i = 0; i < mesBalises.length; i++) {
                        mesBalises[i].addEventListener("click", (e) => {
                            let message = e.currentTarget.getAttribute("data-message"); //affiche le message contenu dans l'attribut message du lien
                            if (!confirm(message)) {
                                e.preventDefault();
                                e.stopPropagation();
                            }
                        })
                    }
                </script>
@endsection
@section('footer')
    @include('footer')
@endsection
