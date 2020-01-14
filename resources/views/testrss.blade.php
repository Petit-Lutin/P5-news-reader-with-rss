@extends('layouts/app')
@section('content')

    <div id="test">
        <input v-model="texte">
        <input type="button" @click="add">
<ul>
    <li v-for="fruit in fruits">@{{fruit}}</li>
</ul>
    </div>
    <script>
        var vue = new Vue({
            el: "#test",
            data:{
                texte:"blabla",
                fruits:['orange', 'banane', 'poire']
            },
            methods: {
                add(){
                    this.fruits.push(this.texte)

                }
            }
        })
    </script>
@endsection
