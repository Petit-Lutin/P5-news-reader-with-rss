@extends('layouts/app')
@section('content')
    {{--    <h1>Flux</h1>--}}
    {{--    <ul>--}}
    {{--        @foreach($flows as $flow)--}}
    {{--            <li>{{$flow->name}} <a href="{{$flow->url}}">lien</a></li>--}}
    {{--        @endforeach--}}
    {{--    </ul>--}}

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Mes abonnements RSS</p>
        </header>
        <div class="card-content">
            <div id="content">
                <table class="table is-hoverable">
                    <thead>
                    <tr>
                        <a class="btn btn-primary" href="/flows/create">Ajouter un site</a>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @foreach($flows as $flow)--}}
                    {{--                        <tr>--}}
                    {{--                            <td>{{$flow->id}}</td>--}}
                    {{--                            <td><strong>{{$flow->name}}</strong></td>--}}
                    {{--                            --}}{{--                            <td><a class="button is-primary" href="{{ route('flows.show', $flow->id) }}">Voir</a></td>--}}
                    {{--                            <td><a class="button is-primary" href="{{ URL::to('flows/'. $flow->id) }}">Voir</a></td>--}}
                    {{--                            --}}{{--                            <td><a class="button is-warning" href="{{ route('flows.edit', $flow->id) }}">Modifier</a></td>--}}
                    {{--                            <td>--}}
                    {{--                                --}}{{--                                <form action="{{ route('flows.destroy', $flow->id) }}" method="post">--}}
                    {{--                                --}}{{--                                    @csrf--}}
                    {{--                                --}}{{--                                    @method('DELETE')--}}
                    {{--                                --}}{{--                                    <button class="button is-danger" type="submit">Supprimer</button>--}}
                    {{--                                --}}{{--                                </form>--}}
                    {{--                            </td>--}}
                    {{--                            <td><strong>{{$category->name}}</strong></td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}


                    </tbody>
                </table>
                <div class="indexContent">
                    <div class="flowsList">
                        @foreach($categories as $category)
                            <h2>{{$category->name}} <small><a
                                        href="/categories/edit/{{$category->id}}">Modifier</a></small> <small><a
                                        href="/category/delete/{{$category->id}}" class="toConfirm"
                                        data-message="Voulez-vous vraiment supprimer cette catégorie ?">Supprimer</a>
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
                            <li v-for="anew in latest"> @{{anew.article_title}} <a v-bind:href="anew.article_link">@{{anew.article_link}}</a>,
                                le @{{ anew.article_date }}
                            </li>
                        </ul>
                        <p> Archives</p>
                        <ul>
                            <li v-for="anew in news"> @{{anew.article_title}} <a v-bind:href="anew.article_link">@{{anew.article_link}}</a>,
                                le @{{ anew.article_date }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{'show':show}">
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
                <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                <script>
                    //script vue js
                    var vue = new Vue({
                        el: "#content",
                        data: {
                            news: [
                                {article_title: "title1", article_link: "link1", article_date: "date"},
                                {article_title: "title2", article_link: "link2", article_date: "date"},
                                {article_title: "title3", article_link: "link3", article_date: "date"}
                            ],
                            latest: [],
                            categories:{!!$jsonCategories!!}, //liste catégories contient liste flux contient liste articles, avec latest ? v-for dans un v-for dans un v-for
                            error: false,
                            show:true,

                            // {titles: ['orange', 'banane', 'poire']},
                            // {links: ['link1', 'link2', 'link3']}]
                            // ,
                            // methods: {
                            //     add(){
                            //         this.fruits.push(this.texte)
                            //
                            //     }
                        },
                        mounted() {
                            for (category of this.categories) {
                                axios.get('/getjson/1')
                                    .then((response) => {
                                        // handle success
                                        this.news = response.data[0].news; //push pour pas écraser résultats
                                        this.articles = this.news;

                                        this.latest = this.news.splice(0, 5);
                                    })
                                    .catch(function (error) {
                                        // handle error
                                        console.log(error);
                                    })
                                    .finally(function () {
                                        // always executed
                                    });
                            }
                        }
                    });

                    // for (i = 0; i <= this.articles.length; i++) {
                    //     this.article = this.articles[i];
                    //
                    //     if (i <= 4) {
                    //         // this.news = response.data[0].news;
                    //         // this.articles = this.news;
                    //
                    //         // this.article = this.articles[i];
                    //
                    //         // console.log(this.articles[i]); //affiche les infos de chaque article
                    //
                    //         // console.log(response.data[0].news[i].article_date); //affiche la date de l'article
                    //         // comparer les dates entre elles, si date + récente pour un même indice article, on ajoute l'article + vieux à old articles
                    //     }
                    //     if (i >= 5) {
                    //
                    //         this.news = response.data[0].news;
                    //         this.articles = this.news;
                    //         this.article = this.articles[i];
                    //         console.log(response.data[0].news[i].article_date);
                    //         var oldNews = response.data[0].news[i];
                    //
                    //         // console.log(this.articles[i]);
                    //         response.data[0].news[i].push(oldNews);
                    //         console.log("this oldnews");
                    //         console.log(oldNews[i]);
                    //     }
                    //     console.log(response.data[0].news[0]);
                    //     // console.log(response.data[0].news[0].article_date);
                    //     // console.log(response.data[0].news[1].article_date);
                    // }

                    // this.oldNews =this.news;
                    // this.fullNews=this.news.push(this.oldNews);
                    // this.total =this.news.push(response.data[0].news);


                    // Make a request for a user with a given ID

                    //

                    const mesBalises = document.querySelectorAll(".toConfirm");
// une modal -> suppresion catégorie
                    //
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
