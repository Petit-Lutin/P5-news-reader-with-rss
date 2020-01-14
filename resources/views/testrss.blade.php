@extends('layouts/app')
@section('content')

    {{--    <div id="testrss">--}}
    {{--        <input v-model="texte">--}}
    {{--        <input type="button" @click="add">--}}
    {{--<ul>--}}
    {{--    <li v-for="article in articles">@{{articles}}</li>--}}
    {{--</ul>--}}
    {{--    </div>--}}
    <form>
        <select onchange="showRSS(this.value)">
            <option value="">Select an RSS-feed:</option>
            <option value="Google">Google News</option>
            <option value="ZDN">ZDNet News</option>
            <option value="Petit Lutin- Draw this again">Petit Lutin- Draw this again</option>
        </select>
    </form>

    <div id="rssOutput">RSS-feed will be listed here...</div>
    <script>
        // var vue = new Vue({
        //     el: "#testrss",
        //     data: {
        //         texte: "blabla",
        //         fruits: ['orange', 'banane', 'poire']
        //     },
        //     methods: {
        //         add() {
        //             this.fruits.push(this.texte)
        //
        //         }
        //     }
        // })
        // var vue = new Vue({
        //     el: "#testrss",
        //     data: {
        //         texte: "F",
        //         fruits: ['orange', 'banane', 'poire']
        //     },
        //     methods: {
        //         add() {
        //             this.fruits.push(this.texte)
        //
        //         }
        //     }
        // })
        function showRSS(flux) {
            if (flux.id.length == 0) {
                document.getElementById("rssOutput").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("rssOutput").innerHTML = document.getElementById("rssOutput").innerHTML + this.responseText;
                }
            }
            xmlhttp.open("GET", "getrss.php?q=" + flux.id, true);
            xmlhttp.send();
        }

        var flux =
            [{
                id: 1
            }, {
                id: 2

            },]

        for (i = 0; i < flux.length; i++) {
            showRSS(flux[i])
        }
    </script>

@endsection
