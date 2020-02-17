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
                        @foreach($categories as $category)
                            <h2>{{$category->name}} <small><a
                                        href="/categories/edit/{{$category->id}}">Modifier</a></small> <small><a
                                        href="/category/delete/{{$category->id}}" class="toConfirm"
                                        data-message="Voulez-vous vraiment supprimer cette catégorie ? Les flux à l'intérieur seront également supprimés de la base de données.">Supprimer</a>
                                </small>
                            </h2>
                            <ul>
                                @foreach($category->flowsOrderBy as $flow)
                                    <li>{{$flow->name}} <a href="/flow/show/{{$flow->id}}">Voir</a>
                                        <small><a href="/flows/edit/{{$flow->id}}">Modifier</a></small>
                                        <small><a href="/flows/delete/{{$flow->id}}" class="toConfirm"
                                                  data-message="Voulez-vous vraiment retirer ce site ?">Supprimer</a>
                                        </small>
                                    </li>
                                @endforeach
                            </ul>

                        @endforeach
                    </div>

                    <div id="flowsContent">Les flux doivent s'afficher ci-dessous, les news doivent être par triées par
                        date décroissante.
                        <button v-if="error" class="btn btn-primary">@{{error}}</button>
                        <ul>
                            <li v-for="category in categories"> @{{ category.category_name}}
                                <ul>
                                    <li v-for="flow in category.flows">
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

                                        <ul>
                                            <li v-for="anew in flow.news"> @{{anew.article_title}} : <a
                                                    v-bind:href="anew.article_link">Lire
                                                    l'article sur le site</a>,
                                                le @{{ anew.article_date }} <br>
                                                <div v-html="anew.article_description"></div>
                                                <p>@{!! anew.article_description !!}</p>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                            </li>


                        </ul>
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

                                categories:{!!$jsonCategories!!},
// , channel_title:"nomduflux", {article_title:"titre"}, //liste catégories contient liste flux contient liste articles, avec latest ? v-for dans un v-for dans un v-for
                                error: false,
                                show: false,
                            },
                            mounted() {
                                {


                                    for (category of this.categories) {
                                        console.log(category.name)

                                        for (flow of category.flows) { // for (i = 0; i < flow.length; i++) poyur la structure/syntaxe, déclarer variable en let
                                            console.log("---", flow.name)

                                            axios.get('/getjson/' + flow.id) // Make a request for a user with a given ID
                                                .then((response) => {
                                                    // handle success

                                                    flow.news = response.data;
                                                    console.log(flow.news)

                                                    // this.latest = this.news.splice(0, 5); // les 5 dernières news affichées à part
                                                })
                                                .catch(function (error) {
                                                    // handle error
                                                    // console.log("flow id", flow.id)
                                                    console.log(error);
                                                })
                                                .finally(function () {
                                                    // always executed
                                                });
                                        }
                                    }
                                }
                            }
                        })
                    ;


                    //     this.article = this.articles[i];

                    //         // console.log(this.articles[i]); //affiche les infos de chaque article
                    //         // console.log(response.data[0].news[i].article_date); //affiche la date de l'article
                    //
                    //     console.log(response.data[0].news[0]);
                    //     // console.log(response.data[0].news[0].article_date);
                    //     // console.log(response.data[0].news[1].article_date);

                    // this.oldNews =this.news;
                    // this.fullNews=this.news.push(this.oldNews);
                    // this.total =this.news.push(response.data[0].news);


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
